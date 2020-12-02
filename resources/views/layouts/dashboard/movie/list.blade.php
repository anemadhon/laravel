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
        <a href="{{route('movies.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Movie</a>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h5>Movies</h5>
                </div>
                <div class="col-4">
                    <form action="{{route('movies')}}" method="get">
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
            @if ($movies->total())
                <table class="table">
                    <tr class="text-center">
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th></th>
                    </tr>
                    @foreach ($movies as $movie)
                        <tr>
                            <td class="col-thumbnail"><img src="{{asset('storage/movies/'.$movie->thumbnail)}}" alt="movie-cover" class="img-fluid"></td>
                            <td><h4><strong>{{$movie->title}}</strong></h4></td>
                            <td><a href="{{route('movies.edit', $movie->id)}}" class="btn btn-sm btn-success" title="Edit"><i class="fas fa-pen"></i></a></td>
                        </tr>
                    @endforeach
                </table>
                {{ $movies->appends($link)->links() }}
            @else
                <h4 class="text-center p-3">Belum Ada Data Movies</h4>
            @endif
        </div>
    </div>
@endsection
