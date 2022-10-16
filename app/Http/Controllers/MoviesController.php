<?php

namespace App\Http\Controllers;

use App\Components\ImportFilmsData;
use App\Components\ImportStaffData;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $import = new ImportFilmsData();
        $importPopularMovies = $import->client->request('GET', 'v2.2/films/top?type=TOP_250_BEST_FILMS&page=1', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $popularMovies = json_decode($importPopularMovies->getBody()->getContents(), true);

        $currentTime = Carbon::now();
        $currentTime->subMonth();
        $subMonth = $currentTime->format('F');
        $subYear = $currentTime->format('Y');
        $premierUri = 'v2.2/films/premieres?year=' . $subYear . '&month=' . $subMonth;

        $importPremieres = $import->client->request('GET', $premierUri, [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $premiers = json_decode($importPremieres->getBody()->getContents(), true);
        $premiersSegment = array_slice($premiers['items'], 0, 20);

//        return view('index', [
//            'popularMovies' => $popularMovies['films'],
//            'premiers' => $premiersSegment
//        ]);

        $viewModel = new MoviesViewModel(
            $popularMovies['films'],
            $premiersSegment
        );

        return view('movies.index', $viewModel);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $importMoviesData = new ImportFilmsData();
        $importMovie = $importMoviesData->client->request('GET', 'v2.2/films/'.$id, [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $importStaffData = new ImportStaffData();
        $importStaff = $importStaffData->client->request('GET', 'staff?filmId='.$id, [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $importMovieImages = $importMoviesData->client->request('GET', 'v2.2/films/'.$id.'/images?type=SCREENSHOT&page=1', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $importSimilarMovies = $importMoviesData->client->request('GET', 'v2.2/films/'.$id.'/similars', [
            'headers' => [
                'X-API-KEY' => config('services.knp.secret'),
                'Content-Type' => 'application/json',
            ]
        ]);
        $movie = json_decode($importMovie->getBody()->getContents(), true);
        $staff = json_decode($importStaff->getBody()->getContents(), true);
        $similarMovies= json_decode($importSimilarMovies->getBody()->getContents(), true);
        $movieImgs = json_decode($importMovieImages->getBody()->getContents(), true);

//        dump($movie);
//        return view('show', compact('movie', 'staff', 'movieImgs'));

        $viewModel = new MovieViewModel(
            $movie,
            $staff,
            $movieImgs,
            $similarMovies
        );

        return view('movies.show', $viewModel);
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
