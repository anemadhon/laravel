@extends('layouts.dashboard.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h5>{{$caption}} Arrange Movie Form</h5>
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
                        {{-- @if(isset($theater))
                            @method('put')
                        @endif --}}
                        <input type="hidden" name="theater_id" value="{{$theater->id}}">
                        <div class="form-group">
                            <label for="movie">Movie</label>
                            <select name="movie_id" id="movieId" class="form-control">
                                <option value="">Pilih Movie</option>
                                @foreach ($movies as $movie)
                                    @if($movie->id === old('movie_id'))
                                        <option value="{{$movie->id}}" selected>{{$movie->title}}</option>
                                    @else 
                                        <option value="{{$movie->id}}">{{$movie->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('movie_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="studio">Studio</label>
                            <input type="text" class="form-control @error('studio') {{'is-invalid'}} @enderror" name="studio" value="{{old('studio') ?? $theater->studio ?? ''}}">
                            @error('studio')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') {{'is-invalid'}} @enderror" name="price" value="{{old('price') ?? $theater->price ?? ''}}">
                            @error('price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group form-row mt-4">
                            <div class="col-2 align-self-center">
                                <label for="seats">Seats</label>
                            </div>
                            <div class="col-5">
                                <input type="number" class="form-control @error('rows') {{'is-invalid'}} @enderror" name="rows" value="{{old('rows') ?? $theater->rows ?? ''}}" placeholder="Rows">
                                @error('rows')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <input type="number" class="form-control @error('columns') {{'is-invalid'}} @enderror" name="columns" value="{{old('columns') ?? $theater->columns ?? ''}}" placeholder="Columns">
                                @error('columns')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label for="schedule">Schedule</label>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <schedule-component :old-schedules="{{json_encode(old('schedules') ?? [])}}"></schedule-component>
                            </div>
                            @error('schedules')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-group mb-0">
                                <label for="status">Status</label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="coming soon" @if((old('status') ?? $theater->status ?? '') == 'coming soon') checked @endif >Coming Soon
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="in theater" @if((old('status') ?? $theater->status ?? '') == 'in theater') checked @endif>In Theater
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="finish" @if((old('status') ?? $theater->status ?? '') == 'finish') checked @endif>Finish
                                </label>
                            </div>
                            @error('status')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
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
