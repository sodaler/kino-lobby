@extends('layouts.main')

@section('content')
    <x-show-movie-card :movie="$movie" :similar-movies="$similarMovies" :staff="$staff" :movie-imgs="$movieImgs"></x-show-movie-card>
@endsection
