<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'MoviesController@show')->name('movies.show');

Route::get('/anime', 'AnimeController@index')->name('anime.index');
Route::get('/anime/{actor}', 'AnimeController@show')->name('anime.show');

Route::get('/filter', 'FilterMoviesController@index')->name('filter.index');

Route::get('/tv', 'TvSeriesController@index')->name('tv.index');
Route::get('/tv/{tv}', 'TvSeriesController@show')->name('tv.show');

