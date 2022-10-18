<div class="relative" x-data="{ isOpen: true }">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        <select
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            wire:model="type">
            <option value="ALL">Все</option>
            <option value="FILM">Фильм</option>
            <option value="TV_SHOW">ТВ-шоу</option>
            <option value="TV_SERIES">Сериал</option>
            <option value="MINI_SERIES">Мини сериал</option>
        </select>
        <select
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            wire:model="year">
            @for ($i = 1991; $i < 2023; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <select
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            wire:model="genre">
            <option value="1">Триллер</option>
            <option value="2">Драма</option>
            <option value="3">Криминал</option>
            <option value="4">Мелодрама</option>
            <option value="5">Детектив</option>
            <option value="6">Фантастика</option>
            <option value="7">Приключения</option>
            <option value="8">Биография</option>
            <option value="10">Вестерн</option>
            <option value="11">Боевик</option>
            <option value="12">Фэнтези</option>
            <option value="13">Комедия</option>
            <option value="14">Военный</option>
            <option value="15">История</option>
            <option value="17">Ужасы</option>
            <option value="18">Мультфильм</option>
            <option value="19">Семейный</option>
            <option value="22">Документальный</option>
            <option value="24">Аниме</option>
        </select>
        <select
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            wire:model="country">
            @foreach($countries as $country)
                <option value="{{ $country['id'] }}">{{ $country['country'] }}</option>
            @endforeach
        </select>
        <select
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            wire:model="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
        <div wire:loading class="spinner my-8"></div>
    </div>

    <div class="mt-5" x-show.transition.opacity="isOpen">
        <ul class="pages">
            @foreach($searchResults['items'] as $result)
                @isset($result['nameRu'])
                    <li class="result border-b border-gray-700" wire:model="filmId = {{ $result['kinopoiskId'] }}">
                        <a href="{{ route('movies.show', $result['kinopoiskId']) }}"
                           class="block hover:bg-gray-700 px-3 py-3 flex transition ease-in-out
                                          duration-150">
                            @if ($result['posterUrlPreview'])
                                <img src="{{ $result['posterUrlPreview'] }}" class="w-36" alt="poster">
                            @else
                                <img src="https://via.placeholder.com/50X75" alt="poster" class="w-8">
                            @endif
                            <div>
                                @if(array_key_exists('nameRu', $result))
                                    <span class="ml-4">{{ $result['nameRu'] }}</span>
                                @else
                                    <span class="ml-4">Без названия</span>
                                @endif
                                <div class="flex items-center text-gray-400 text-sm mt-1 ml-4">
                                    <svg class="fill-current text-orange-500 w-4" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                    <span class="ml-1">{{ $result['ratingKinopoisk'] }}</span>
                                    <span class="mx-2">|</span>
                                    <span>{{ $result['year'] }}</span>
                                </div>
                                <div class="text-gray-400 text-sm ml-4">
                                    @foreach($result['genres'] as $genre)
                                        {{ $genre['genre'] }}@if (!$loop->last), @endif
                                    @endforeach
                                </div>

                            </div>
                        </a>
                    </li>
                @endisset
            @endforeach
        </ul>
    </div>

    {{--    <div class="popular-actors">--}}
    {{--        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>--}}
    {{--        <div class="pages grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">--}}
    {{--            @foreach ($searchResults as $result)--}}
    {{--                <div class="result mt-8">--}}
    {{--                    <a href="#">--}}
    {{--                        <img src="{{ $result['posterUrlPreview'] }}" alt="profile image" class="hover:opacity-75 transition ease-in-out duration-150">--}}
    {{--                    </a>--}}
    {{--                    <div class="mt-2">--}}
    {{--                        <a href="#" class="text-lg hover:text-gray-300">{{ $result['nameRu'] }}</a>--}}
    {{--                        <div class="text-sm truncate text-gray-400">hello</div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            @endforeach--}}

    {{--        </div>--}}
    {{--    </div> <!-- end popular-actors -->--}}


    <div class="page-load-status my-8">
        <div class="flex justify-center">
            @if ($searchResults['items'] && $searchResults['totalPages'] > 1)
                <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
            @endif
        </div>
    </div>

    @section('scripts')
        <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
        <script>
            var elem = document.querySelector('.pages');
            var infScroll = new InfiniteScroll(elem, {
                path: '/filter/?page=@{{#}}',
                append: '.result',
                status: '.page-load-status',
                // history: false,
            });
        </script>
@endsection
