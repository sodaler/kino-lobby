<div class="relative" x-data="{ isOpen: true }">
    <div wire:loading class="spinner"></div>
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
    </div>
    <div class="mt-5">
        @if (!empty($searchResults))
            @if (count($searchResults) > 0)
                <ul>
                    @foreach($searchResults as $result)
                        @isset($result['nameRu'])
                            <li class="border-b border-gray-700">
                                <a href="{{ route('movies.show', $result['kinopoiskId']) }}"
                                   class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out
                                          duration-150"
                                   @if($loop->last)
                                   @keydown.tab="isOpen = false"
                                    @endif
                                >
                                    @if ($result['posterUrlPreview'])
                                        <img src="{{ $result['posterUrlPreview'] }}" class="w-36" alt="poster">
                                    @else
                                        <img src="https://via.placeholder.com/50X75" alt="poster" class="w-8">
                                    @endif
                                    @if(array_key_exists('nameRu', $result))
                                        <span class="ml-4">{{ $result['nameRu'] }}</span>
                                    @else
                                        <span class="ml-4">Без названия</span>
                                    @endif
                                </a>
                            </li>
                        @endisset
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">Нет результатов</div>
            @endif
        @endif

        {{ $searchResults->links('vendor.livewire.tailwind') }}
    </div>
</div>
