<?php

namespace App\Http\Controllers;

use App\Components\ImportFilmsData;
use Illuminate\Http\Request;

class FilterMoviesController extends Controller
{
    /**
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
        return view('filter.index', [
            'popularMovies' => $popularMovies['films']
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
