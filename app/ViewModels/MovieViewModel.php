<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $staff;
    public $movieImgs;

    public function __construct($movie, $staff, $movieImgs)
    {
        $this->movie = $movie;
        $this->staff = $staff;
        $this->movieImgs = $movieImgs;
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

}
