@extends('layouts.dashboard.dashboard')

@section('content')
    @if(session()->has('message'))
    <div class="alert alert-success">
        <strong>{{session()->get('message')}}</strong>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif
    <div class="mb-2">
        <a href="{{route('theaters.arrange.movie.create', $theater->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Arrange Movie</a>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h5>Arrange Movie</h5>
                </div>
                <div class="col-4">
                    <form action="{{route('theaters.arrange.movie', $theater->id)}}" method="get">
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
        {{-- <div class="card-body p-0">
            @if ($theaters->total())
                <table class="table">
                    <tr class="text-center">
                        <th>Theater</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                    @foreach ($theaters as $theater)
                        <tr>
                            <td>{{$theater->theater}}</td>
                            <td>{{$theater->address}}</td>
                            <td>
                                <a href="{{route('theaters.edit', $theater->id)}}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-pen"></i></a>
                                <a href="{{route('theaters.arrange.movie', $theater->id)}}" class="btn btn-sm btn-primary" title="Arrange Movie"><i class="fas fa-film"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $theaters->appends($link)->links() }}
            @else
                <h4 class="text-center p-3">Belum Ada Data Theaters</h4>
            @endif
        </div> --}}
    </div>
@endsection
