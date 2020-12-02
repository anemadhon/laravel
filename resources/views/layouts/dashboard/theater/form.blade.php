@extends('layouts.dashboard.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h5>{{$caption}} Theater Form</h5>
                </div>
                @if(isset($theater))
                <div class="col-4 text-right align-self-center">
                    <button class="btn btn-sm text-danger" data-toggle="modal" data-target="#modalDelete"><i class="fas fa-trash"></i> Delete</button>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body m-0">
            <div class="row">
                <div class="col-md-8 ml-4">
                    <form action="{{route($url, $theater->id ?? '')}}" method="post">
                        @csrf
                        @if(isset($theater))
                            @method('put')
                        @endif
                        <div class="form-group">
                            <label for="theater">Theater</label>
                            <input type="text" class="form-control @error('theater') {{'is-invalid'}} @enderror" name="theater" value="{{old('theater') ?? $theater->theater ?? ''}}">
                            @error('theater')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control @error('address') {{'is-invalid'}} @enderror">{{old('address') ?? $theater->address ?? ''}}</textarea>
                            @error('address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-group mb-0">
                                <label for="status">Status</label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="active" @if((old('status') ?? $theater->status ?? '') == 'active') checked @endif >Active
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="inactive" @if((old('status') ?? $theater->status ?? '') == 'inactive') checked @endif>Inactive
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="button" class="btn btn-sm btn-secondary" onclick="window.history.back()"><i class="fas fa-times"></i> Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> {{$caption}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($theater))    
    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus Theater <strong>{{$theater->title}}</strong></p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('theaters.delete', $theater->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
