@extends('layouts.dashboard.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h5>{{$caption}} Movie Form</h5>
                </div>
                @if(isset($movie))
                <div class="col-4 text-right align-self-center">
                    <button class="btn btn-sm text-danger" data-toggle="modal" data-target="#modalDelete"><i class="fas fa-trash"></i> Delete</button>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body m-0">
            <div class="row">
                <div class="col-md-8 ml-4">
                    <form action="{{route($url, $movie->id ?? '')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($movie))
                            @method('put')
                        @endif
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') {{'is-invalid'}} @enderror" name="title" value="{{old('title') ?? $movie->title ?? ''}}">
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') {{'is-invalid'}} @enderror">{{old('description') ?? $movie->description ?? ''}}</textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <div class="custom-file">
                                <label for="thumbnail" class="custom-file-label">Thumbnail</label>
                                <input type="file" class="custom-file-input" name="thumbnail" value="{{old('thumbnail')}}">
                                @error('thumbnail')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
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
    @if(isset($movie))    
    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus Movie <strong>{{$movie->title}}</strong></p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('movies.delete', $movie->id)}}" method="post">
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
