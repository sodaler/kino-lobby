<?php

namespace App\Http\Livewire;

use App\Components\ImportFilmsData;
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
        if (empty($this->type)) {
            $import = new ImportFilmsData();
            $importSearchResults = $import->client->request('GET', 'v2.2/films?order=RATING&type=FILM&ratingFrom=7&ratingTo=10&yearFrom=2022&yearTo=3000&page='.$this->page, [
                'headers' => [
                    'X-API-KEY' => config('services.knp.secret'),
                    'Content-Type' => 'application/json',
                ]
            ]);
            $searchResults = json_decode($importSearchResults->getBody()->getContents(), true);
        }

        $import = new ImportFilmsData();
        $importCountries = $import->client->request('GET', 'v2.2/films/filters', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $countries = json_decode($importCountries->getBody()->getContents(), true);

        if (!empty($this->type)) {
            $import = new ImportFilmsData();
            $ratingTo = $this->rating + 1;
            $importSearchResults = $import->client->request('GET', 'v2.2/films?order=NUM_VOTE&type='.$this->type.'&ratingFrom='.$this->rating.'&ratingTo='.$ratingTo.'&yearFrom='.$this->year.'&yearTo='.$this->year.'&genres='.$this->genre.'&countries='.$this->country.'&page='.$this->page, [
                'headers' => [
                    'X-API-KEY' => config('services.knp.secret'),
                    'Content-Type' => 'application/json',
                ]
            ]);
            $searchResults = json_decode($importSearchResults->getBody()->getContents(), true);
        }

//        dd($searchResults);

//        dump($searchResults);

        return view('livewire.filter-movies', [
            'searchResults' => collect($searchResults['items'])->paginate(7),
            'countries' => $countries['countries']
        ]);
    }
}
