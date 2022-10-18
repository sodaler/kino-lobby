@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div id="carouselExampleIndicators" class="carousel slide relative lg:h-2/3 mb-20" data-bs-ride="carousel">
            <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
                <button
                    type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="0"
                    class="active"
                    aria-current="true"
                    aria-label="Slide 1"
                ></button>
                <button
                    type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="1"
                    aria-label="Slide 2"
                ></button>
                <button
                    type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="2"
                    aria-label="Slide 3"
                ></button>
            </div>
            <div class="carousel-inner relative w-full overflow-hidden">
                <div class="carousel-item active float-left w-full" style="max-height: 700px">
                    <img
                        src="img/top_gun.webp"
                        class="block w-full h-full"
                        alt="Wild Landscape"
                    />
                </div>
                <div class="carousel-item float-left w-full" style="max-height: 700px">
                    <img
                        src="img/uncharted.webp"
                        class="block w-full"
                        alt="Exotic Fruits"
                    />
                </div>
                <div class="carousel-item float-left w-full" style="max-height: 700px">
                    <img
                        src="img/red.webp"
                        class="block w-full"
                        alt="Camera"
                    />
                </div>
            </div>
            <button
                class="text-gray-900 carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev"
            >
                <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next"
            >
                <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
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
