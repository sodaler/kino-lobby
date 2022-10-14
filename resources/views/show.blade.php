@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $movie['posterUrl'] }}" alt="parasite" class="w-64 lg:w-96">
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['nameRu'] . ' (' . $movie['year'] . ')' }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <svg class="fill-current text-orange-500 w-4" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <span class="ml-1">{{ $movie['ratingKinopoisk'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['year'] }}</span>
                    <span class="mx-2">|</span>
                    <span> @foreach($movie['genres'] as $genre)
                            {{ $genre['genre'] }}@if (!$loop->last), @endif
                        @endforeach</span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $movie['description'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Ключевой состав</h4>
                    <div class="flex mt-4">
                        @foreach($staff as $crew)
                            @if ($loop->index < 2)
                                @if(!empty($crew['nameRu']))
                                    <div class="mr-8">
                                        <div>{{ $crew['nameRu'] }}</div>
                                        <div
                                            class="text-sm text-gray-400">{{ mb_substr($crew['professionText'], 0, -1) }}</div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="mt-12">
                    <a href="#watchMovie">
                        <button class="btn flex items-center bg-orange-400 text-gray-900 rounded font-semibold px-5
                        py-4 hover:bg-orange-500 transition ease-in-out duration-150r">
                            <svg class="w-6 fill-current" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                            </svg>
                            <span class="ml-2">Смотреть фильм</span>
                        </button>
                    </a>
                </div>
            </div>
        </div> <!-- end movie-info -->

        <div class="movie-cast border-b border-gray-800" id="watchMovie">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">{{ $movie['nameRu'] . ' | Смотреть онлайн' }}</h2>
                <div class="shadow-cyan-50">
                    <div class="mt-8">
                        <div id="kinoplayertop" data-kinopoisk="{{ $id }}"
                             data-shearch="false"></div>
                        <script src="//kinoplayer.top/top.js"></script>
                    </div>
                </div>
            </div>
        </div> <!-- end movie-cast -->


        <div class="movie-cast border-b border-gray-800">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Ключевой состав</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach($staff as $cast)
                        @if($loop->index < 5)
                            @if(!empty($cast['nameRu']))
                                <div class="mt-8">
                                    <a href="#">
                                        <img src="{{ $cast['posterUrl'] }}" alt="parasite"
                                             class="hover:opacity-75 transition ease-in-out duration-150 object-contain w-96 h-96">
                                    </a>
                                    <div class="mt-2">
                                        <a href="#" class="text-lg mt-2 hover:text-gray:300">{{ $cast['nameRu'] }}</a>
                                        <div class="text-sm text-gray-400">
                                            {{ mb_substr($cast['professionText'], 0, -1) }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div> <!-- end movie-cast -->

        <div class="movie-images" x-data="{ isOpen: false, image: '' }">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Изображения</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach($movieImgs['items'] as $img)
                        @if($loop->index < 9)
                            <div class="mt-8">
                                <a href="#"
                                    @click.prevent="
                                        isOpen = true
                                        image='{{ $img['imageUrl'] }}'
                                        "
                                >
                                    <img src="{{ $img['imageUrl'] }}" alt="parasite"
                                         class="hover:opacity-75 transition ease-in-out duration-150">
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    x-show="isOpen"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    @click="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="image" alt="poster">
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end movie-images -->
        </div>



@endsection
