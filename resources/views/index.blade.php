@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-400 text-lg font-semibold">
                Популярные фильмы
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularMovies as $popularMovie)
                    <x-movie-card :popularMovie="$popularMovie"/>
                @endforeach
            </div>
        </div>

{{--        <div id="yohoho" data-title="Зина & Лёха: Операция «Хвост и вымя»"></div>--}}
{{--        <script src="//yohoho.cc/yo.js"></script>--}}

        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-orange-400 text-lg font-semibold">
                Премьеры в России
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($premiers as $premier)
                    <x-premier-card :premier="$premier"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
