<?php

namespace App\Http\Livewire;

use App\Components\ImportFilmsData;
use App\ViewModels\FilterMoviesViewModel;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class FilterMovies extends Component
{
    use WithPagination;

    public $type = 'ALL';
    public $year = '2022';
    public $genre = '1';
    public $country = '';
    public $rating = 7;

    public function render()
    {
        $searchResults = [];
        $import = new ImportFilmsData();
        $importCountries = $import->client->request('GET', 'v2.2/films/filters', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $countries = json_decode($importCountries->getBody()->getContents(), true);

        $ratingTo = $this->rating + 1;
        $importSearchResults = $import->client->request('GET', 'v2.2/films?order=NUM_VOTE&type=' . $this->type . '&ratingFrom=' . $this->rating . '&ratingTo=' . $ratingTo . '&yearFrom=' . $this->year . '&yearTo=' . $this->year . '&genres=' . $this->genre . '&countries=' . $this->country . '&page=' . $this->page, [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $searchResults = json_decode($importSearchResults->getBody()->getContents(), true);


        $viewModel = new FilterMoviesViewModel($countries['countries'], $searchResults, $this->page);

        return view('livewire.filter-movies', $viewModel);

    }
}
