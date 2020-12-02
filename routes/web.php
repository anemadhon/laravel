<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');
    Route::get('/dashboard/theaters', 'Dashboard\TheaterController@index')->name('theaters');
    Route::get('/dashboard/tickets', 'Dashboard\TicketController@index')->name('tickets');
    
    //Movies
    Route::get('/dashboard/movies', 'Dashboard\MovieController@index')->name('movies');
    Route::get('/dashboard/movies/create', 'Dashboard\MovieController@create')->name('movies.create');
    Route::post('/dashboard/movies', 'Dashboard\MovieController@store')->name('movies.store');
    Route::get('/dashboard/movies/{movie}', 'Dashboard\MovieController@edit')->name('movies.edit');
    Route::put('/dashboard/movies/{movie}', 'Dashboard\MovieController@update')->name('movies.update');
    Route::delete('/dashboard/movies/{movie}', 'Dashboard\MovieController@destroy')->name('movies.delete');
    
    //Theaters
    Route::get('/dashboard/theaters', 'Dashboard\TheaterController@index')->name('theaters');
    Route::get('/dashboard/theaters/create', 'Dashboard\TheaterController@create')->name('theaters.create');
    Route::post('/dashboard/theaters', 'Dashboard\TheaterController@store')->name('theaters.store');
    Route::get('/dashboard/theaters/{theater}', 'Dashboard\TheaterController@edit')->name('theaters.edit');
    Route::put('/dashboard/theaters/{theater}', 'Dashboard\TheaterController@update')->name('theaters.update');
    Route::delete('/dashboard/theaters/{theater}', 'Dashboard\TheaterController@destroy')->name('theaters.delete');
    
    //Arrange Movie
    Route::get('/dashboard/theaters/arrange/movie/{theater}', 'Dashboard\ArrangeMovieController@index')->name('theaters.arrange.movie');
    Route::get('/dashboard/theaters/arrange/movie/create/{theater}', 'Dashboard\ArrangeMovieController@create')->name('theaters.arrange.movie.create');
    Route::post('/dashboard/theaters/arrange/movie', 'Dashboard\ArrangeMovieController@store')->name('theaters.arrange.movie.store');
    Route::get('/dashboard/theaters/arrange/movie/{arrangMovie}', 'Dashboard\ArrangeMovieController@edit')->name('theaters.arrange.movie.edit');
    Route::put('/dashboard/theaters/arrange/movie/{arrangMovie}', 'Dashboard\ArrangeMovieController@update')->name('theaters.arrange.movie.update');
    Route::delete('/dashboard/theaters/arrange/movie/{arrangMovie}', 'Dashboard\ArrangeMovieController@destroy')->name('theaters.arrange.movie.delete');

    //Users
    Route::get('/dashboard/users', 'Dashboard\UserController@index')->name('users');
    Route::get('/dashboard/users/{id}', 'Dashboard\UserController@edit')->name('users.edit');
    Route::put('/dashboard/users/{id}', 'Dashboard\UserController@update')->name('users.update');
    Route::delete('/dashboard/users/{id}', 'Dashboard\UserController@destroy')->name('users.delete');
});

