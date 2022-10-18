<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $staff;
    public $movieImgs;
    public $similarMovies;

    public function __construct($movie, $staff, $movieImgs, $similarMovies)
    {
        $this->movie = $movie;
        $this->staff = $staff;
        $this->movieImgs = $movieImgs;
        $this->similarMovies = $similarMovies;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'genres' => collect($this->movie['genres'])->pluck('genre')->implode(', ')
        ])->only([
            'posterUrl', 'nameRu', 'year', 'ratingKinopoisk', 'genres', 'description', 'kinopoiskId'
        ]);
    }

    public function staff()
    {
        return collect($this->staff)->merge([
            'crew' => collect($this->staff)->take(2),
            'cast' => collect($this->staff)->take(5),
        ])->only([
            'posterUrl', 'nameRu', 'year', 'ratingKinopoisk', 'genres', 'description', 'kinopoiskId',
            'crew', 'cast'
        ]);
    }

    public function movieImgs()
    {
        return collect($this->movieImgs)->merge([
            'imageUrls' => collect($this->movieImgs['items'])->take(9),
        ])->only([
            'imageUrls'
        ]);
    }

    public function similarMovies()
    {
        return collect($this->similarMovies['items'])->map(function ($movie) {
            return collect($movie)->only([
               'nameRu', 'filmId', 'posterUrl'
            ]);
        });
    }

}
