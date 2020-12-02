<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ArrangeMovie;
use App\Models\Theater;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArrangeMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theater $theater)
    {
        $active = 'Theaters';
        /* $key = $request->input('key');
        $arrangeMovie = $arrangeMovie->when($key, function($query) use ($key) {
                        return $query->where('theater', 'like', '%'.$key.'%');
                    })->paginate(10); */
        
        $link = $request->all();
        return view('layouts.dashboard.arrange_movie.list', [
            'theater' => $theater,
            'link' => $link,
            'active' => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Theater $theater)
    {
        $active = 'Theaters';
        $movies = Movie::get();
        return view('layouts.dashboard.arrange_movie.form',[
            'theater' => $theater,
            'active' => $active,
            'movies' => $movies,
            'url' => 'theaters.arrange.movie.store',
            'caption' => 'Create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ArrangeMovie $arrangeMovie)
    {
        $validator = Validator::make($request->all(),[
            'theater_id' => 'required',
            'movie_id' => 'required',
            'studio' => 'required',
            'price' => 'required',
            'rows' => 'required',
            'columns' => 'required',
            'schedules' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('theaters.arrange.movie.create', $request->input('theater_id'))->withInput()->withErrors($validator);
        } else {

            $seats = [
                'rows' => $request->input('rows'),
                'columns' => $request->input('columns')
            ];

            $arrangeMovie->theater_id = $request->input('theater_id');
            $arrangeMovie->movie_id = $request->input('movie_id');
            $arrangeMovie->studio = $request->input('studio');
            $arrangeMovie->price = $request->input('price');
            $arrangeMovie->seats = json_encode($seats);
            $arrangeMovie->schedules = json_encode($request->input('schedules'));
            $arrangeMovie->status = $request->input('status');

            $arrangeMovie->save();
            return redirect()->route('theaters.arrange.movie', $request->input('theater_id'))->with('message', "Data Studio Baru ({$request->input('studio')}) Berhasil ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function show(ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function edit(ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArrangeMovie $arrangeMovie)
    {
        //
    }
}
