<?php

namespace App\Http\Controllers;

use App\Components\ImportFilmsData;
use App\Components\ImportStaffData;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *@return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $import = new ImportFilmsData();
        $importPopularAnime = $import->client->request('GET', 'v2.2/films?genres=24&order=NUM_VOTE&type=ALL&page=1', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $popularAnime = json_decode($importPopularAnime->getBody()->getContents(), true);

        $importBestAnime = $import->client->request('GET', 'v2.2/films?genres=24&order=RATING&type=ALL&page=1', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $bestAnime = json_decode($importBestAnime->getBody()->getContents(), true);

        return view('anime.index', [
            'popularAnime' => $popularAnime['items'],
            'bestAnime' => $bestAnime['items']
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
