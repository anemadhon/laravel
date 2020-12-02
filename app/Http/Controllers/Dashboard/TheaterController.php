<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Theater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TheaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theater $theaters)
    {
        $active = 'Theaters';
        $key = $request->input('key');
        $theaters = $theaters->when($key, function($query) use ($key) {
                        return $query->where('theater', 'like', '%'.$key.'%');
                    })->paginate(10);
        
        $link = $request->all();
        return view('layouts.dashboard.theater.list', [
            'theaters' => $theaters,
            'link' => $link,
            'active' => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Theaters';
        return view('layouts.dashboard.theater.form', ['active' => $active, 'url' => 'theaters.store', 'caption' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Theater $theater)
    {
        $validator = Validator::make($request->all(),[
            'theater' => 'required|unique:App\Models\Theater,theater',
            'address' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('theaters.create')->withInput()->withErrors($validator);
        } else {
            $theater->theater = $request->input('theater');
            $theater->address = $request->input('address');
            $theater->status = $request->input('status');

            $theater->save();
            return redirect()->route('theaters')->with('message', "Data Theater Baru ({$request->input('theater')}) Berhasil ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function show(Theater $theater)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function edit(Theater $theater)
    {
        $active = 'Theaters';
        return view('layouts.dashboard.theater.form', ['theater' => $theater, 'active' => $active, 'url' => 'theaters.update', 'caption' => 'Update']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theater $theater)
    {
        $validator = Validator::make($request->all(),[
            'theater' => 'required|unique:App\Models\Theater,theater,'.$theater->id,
            'address' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('theaters.edit', $theater->id)->withInput()->withErrors($validator);
        } else {
            $theater->theater = $request->input('theater');
            $theater->address = $request->input('address');
            $theater->status = $request->input('status');

            $theater->save();
            return redirect()->route('theaters')->with('message', "Data Theater ({$theater->theater}) Berhasil diubah");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theater $theater)
    {
        $title = $theater->theater;
        $theater->delete();
        return redirect()->route('theaters')->with('message', "Data Theater ({$title}) Berhasil dihapus");
    }
}
