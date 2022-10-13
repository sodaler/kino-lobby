<?php

namespace App\Http\Livewire;

use App\Components\ImportFilmsData;
use Livewire\Component;


class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $import = new ImportFilmsData();
            $importSearchResults = $import->client->request('GET', 'v2.1/films/search-by-keyword?keyword='.$this->search, [
                'headers' => [
                    'X-API-KEY' => config('services.knp.secret'),
                    'Content-Type' => 'application/json',
                ]
            ]);
            $searchResults = json_decode($importSearchResults->getBody()->getContents(), true);
        }

//        dd($searchResults);

//        dump($searchResults);

        return view('livewire.search-dropdown', [
            'searchResults' => $searchResults,
        ]);
    }
}
