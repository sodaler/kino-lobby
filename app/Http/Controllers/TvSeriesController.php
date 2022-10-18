<?php

namespace App\Http\Controllers;

use App\Components\ImportFilmsData;
use App\Components\ImportStaffData;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;

class TvSeriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $import = new ImportFilmsData();
        $importPopularSeries = $import->client->request('GET', 'v2.2/films?order=NUM_VOTE&type=TV_SERIES&yearFrom=2019&yearTo=2022&page=1', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $popularSeries = json_decode($importPopularSeries->getBody()->getContents(), true);

        $importBestSeries = $import->client->request('GET', 'v2.2/films?genres=2&countries=1&order=RATING&type=TV_SERIES&yearFrom=2019&yearTo=2022&page=1', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $bestSeries = json_decode($importBestSeries->getBody()->getContents(), true);

        return view('tv.index', [
            'popularSeries' => $popularSeries['items'],
            'bestSeries' => $bestSeries['items']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $importMoviesData = new ImportFilmsData();
        $importMovie = $importMoviesData->client->request('GET', 'v2.2/films/' . $id, [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $importStaffData = new ImportStaffData();
        $importStaff = $importStaffData->client->request('GET', 'staff?filmId=' . $id, [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $importMovieImages = $importMoviesData->client->request('GET', 'v2.2/films/' . $id . '/images?type=SCREENSHOT&page=1', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $importSimilarMovies = $importMoviesData->client->request('GET', 'v2.2/films/' . $id . '/similars', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $movie = json_decode($importMovie->getBody()->getContents(), true);
        $staff = json_decode($importStaff->getBody()->getContents(), true);
        $similarMovies = json_decode($importSimilarMovies->getBody()->getContents(), true);
        $movieImgs = json_decode($importMovieImages->getBody()->getContents(), true);

        if (empty($movieImgs['items'])) {
            $importMovieImages = $importMoviesData->client->request('GET', 'v2.2/films/' . $id . '/images?type=STILL&page=1', [
                'headers' => [
                    'X-API-KEY' => config('services.knp.secret'),
                    'Content-Type' => 'application/json',
                ]
            ]);
            $movieImgs = json_decode($importMovieImages->getBody()->getContents(), true);
        }

//        dump($movie);
//        return view('show', compact('movie', 'staff', 'movieImgs'));

        $viewModel = new MovieViewModel(
            $movie,
            $staff,
            $movieImgs,
            $similarMovies
        );

        return view('tv.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
