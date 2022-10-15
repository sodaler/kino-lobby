<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $premiers;

    public function __construct($popularMovies, $premiers)
    {
        $this->popularMovies = $popularMovies;
        $this->premiers = $premiers;
    }

    public function popularMovies()
    {
        return collect($this->popularMovies)->map(function ($movie) {
            return collect($movie)->only([
               'filmId', 'nameRu', 'posterUrl', 'rating', 'year', 'genres'
            ]);
        });
    }

    public function premiers()
    {
        return $this->premiers;
    }
}
