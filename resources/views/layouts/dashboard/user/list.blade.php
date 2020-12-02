@extends('layouts.dashboard.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h5>Users</h5>
                </div>
                <div class="col-4">
                    <form action="{{route('users')}}" method="get">
                        <div class="input-group">
                            <input type="text" name="key" placeholder="{{isset($link['key']) ? 'Your Search : '.$link['key'] : ''}}" class="form-control form-control-sm">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm" title="Search"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($users->total())
                <table class="table">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered</th>
                        <th>Updated</th>
                        <th></th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{(($users->currentPage() - 1) * $users->perPage()) + $loop->iteration}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td><a href="{{route('users.edit', ['id' => $user->id])}}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-pen"></i></a></td>
                        </tr>
                    @endforeach
                </table>
                {{ $users->appends($link)->links() }}
            @else
                <h4 class="text-center p-3">Belum Ada Data Users</h4>
            @endif
        </div>
    </div>
@endsection
