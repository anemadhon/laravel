@extends('layouts.dashboard.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h5>User Edit Form</h5>
                </div>
                <div class="col-4 text-right align-self-center">
                    <button class="btn btn-sm text-danger" data-toggle="modal" data-target="#modalDelete"><i class="fas fa-trash"></i> Delete</button>
                </div>
            </div>
        </div>
        <div class="card-body m-0">
            <div class="row">
                <div class="col-md-8 ml-4">
                    <form action="{{route('users.update', ['id' => $user->id])}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') {{'is-invalid'}} @enderror" name="name" value="{{$user->name}}">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') {{'is-invalid'}} @enderror" name="email" value="{{old('email') ?? $user->email}}">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <button type="button" class="btn btn-sm btn-secondary" onclick="window.history.back()"><i class="fas fa-times"></i> Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus User <strong>{{$user->name}}</strong></p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('users.delete', ['id' => $user->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
