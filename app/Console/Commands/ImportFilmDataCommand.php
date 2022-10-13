<?php

namespace App\Console\Commands;

use App\Components\ImportFilmsData;
use Illuminate\Console\Command;

class ImportFilmDataCommand extends Command
{
    protected $signature = 'import:filmData';

    protected $description = 'import film data';

    public function handle()
    {
        $import = new ImportFilmsData();
        $popularMovies = $import->client->request('GET', 'films/top?type=TOP_100_POPULAR_FILMS&page=1', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);

        dd(json_decode($popularMovies->getBody()->getContents()));
    }
}
