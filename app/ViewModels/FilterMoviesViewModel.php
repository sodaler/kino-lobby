<?php

namespace App\ViewModels;

use App\Components\ImportFilmsData;
use Spatie\ViewModels\ViewModel;

class FilterMoviesViewModel extends ViewModel
{
    public $countries;
    public $searchResults;
    public $page;
//    public $type = 'ALL';
//    public $year = '2022';
//    public $genre = '1';
//    public $country = '';
//    public $rating = 7;

    public function __construct($countries, $searchResults, $page)
    {
        $this->countries = $countries;
        $this->searchResults = $searchResults;
        $this->page = $page;
//        $this->type = $type;
//        $this->year = $year;
//        $this->genre = $genre;
//        $this->country = $country;
//        $this->rating = $rating;
    }

    public function countries()
    {
//        $import = new ImportFilmsData();
//        $importCountries = $import->client->request('GET', 'v2.2/films/filters', [
//            'headers' => [
//                'X-API-KEY' => config('services.knp.secret'),
//                'Content-Type' => 'application/json',
//            ]
//        ]);
        return $this->countries;
    }

    public function searchResults()
    {
//        $import = new ImportFilmsData();
//        $ratingTo = $this->rating + 1;
//        $importSearchResults = $import->client->request('GET', 'v2.2/films?order=NUM_VOTE&type='.$this->type.'&ratingFrom='.$this->rating.'&ratingTo='.$ratingTo.'&yearFrom='.$this->year.'&yearTo='.$this->year.'&genres='.$this->genre.'&countries='.$this->country.'&page='.$this->page, [
//            'headers' => [
//                'X-API-KEY' => config('services.knp.secret'),
//                'Content-Type' => 'application/json',
//            ]
//        ]);
        return $this->searchResults;
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < $this->searchResults['totalPages'] ? $this->page + 1 : null;
    }
}
