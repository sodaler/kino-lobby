<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 rounded-full px-4 pl-8 py-1 focus:outline-1 focus:shadow-sm"
        placeholder="Поиск"
        x-ref="search"
        @keydown.window="
            if (event.keyCode == 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-5 text-gray-500 mt-1 ml-2" width="24" height="24" viewBox="0 0 24 24">
            <path
                d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
        </svg>
    </div>

    <div wire:loading class="spinner top-1 right-0 mr-4 mt-3"></div>

    @if (strlen($search) >= 2)
        <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
             x-show.transition.opacity="isOpen">
            @if (!empty($searchResults['films']))
                @if (count($searchResults['films']) > 0)
                    <ul>
                        @foreach($searchResults['films'] as $result)
                            <li class="border-b border-gray-700">
                                <a href="{{ route('movies.show', $result['filmId']) }}"
                                   class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out
                                          duration-150"
                                   @if($loop->last)
                                   @keydown.tab="isOpen = false"
                                    @endif
                                >
                                    @if ($result['posterUrlPreview'])
                                        <img src="{{ $result['posterUrlPreview'] }}" class="w-8" alt="poster">
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
                        @endforeach
                    </ul>
                @else
                    <div class="px-3 py-3">Нет результатов</div>
                @endif
            @endif
        </div>
    @endif
</div>
