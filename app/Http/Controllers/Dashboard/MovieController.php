<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Movie $movies)
    {
        $active = 'Movies';
        $key = $request->input('key');
        $movies = $movies->when($key, function($query) use ($key) {
                                return $query->where('title','like','%'.$key.'%');
                            })->paginate(10);
        $link = $request->all();
        return view('layouts.dashboard.movie.list', ['movies' => $movies, 'active' => $active, 'link' => $link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Movies';
        return view('layouts.dashboard.movie.form', ['active' => $active, 'url' => 'movies.store', 'caption' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:App\Models\Movie,title',
            'description' => 'required',
            'thumbnail' => 'required|image'
        ]);

        if ($validator->fails()) {
            return redirect()->route('movies.create')->withErrors($validator)->withInput();
        } else {
            $image = $request->file('thumbnail');
            $filename = time().'.'.$image->getClientOriginalExtension();

            Storage::disk('local')->putFileAs('public/movies', $image, $filename);

            $movie->title = $request->input('title');
            $movie->description = $request->input('description');
            $movie->thumbnail = $filename;
            $movie->save();

            return redirect()->route('movies')->with('message', "Data Movie Baru ({$request->input('title')}) Berhasil ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $active = 'Movies';
        return view('layouts.dashboard.movie.form', ['active' => $active, 'movie' => $movie, 'url' => 'movies.update', 'caption' => 'Update']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:App\Models\Movie,title,'.$movie->id,
            'description' => 'required',
            'thumbnail' => 'image'
        ]);

        if ($validator->fails()) {
            return redirect()->route('movies.edit', $movie->id)->withErrors($validator)->withInput();
        } else {
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $filename = time().'.'.$image->getClientOriginalExtension();
    
                Storage::disk('local')->putFileAs('public/movies', $image, $filename);
                $movie->thumbnail = $filename;
            }

            $movie->title = $request->input('title');
            $movie->description = $request->input('description');
            $movie->save();

            return redirect()->route('movies')->with('message', "Data Movie {$request->input('title')} Berhasil diubah");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $oldTitle = $movie->title;
        $movie->delete();
        return redirect()->route('movies')->with('message', "Data Movie {$oldTitle} Berhasil dihapus");
    }
}
