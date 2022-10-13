<div class="mt-8">
    <a href="{{ route('movies.show', $premier['kinopoiskId']) }}">
        <img src="{{ $premier['posterUrl'] }}" alt="parasite" class="hover:opacity-75 transition
                        ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="{{ route('movies.show', $premier['kinopoiskId']) }}" class="text-lg mt-2 hover:text-gray-300">
            {{ $premier['nameRu'] }}
        </a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <span>
                @foreach($premier['countries'] as $country)
                    {{ $country['country'] }}@if (!$loop->last), @endif
                @endforeach
            </span>
            <span class="mx-2">|</span>
            <span>{{ $premier['year'] }}</span>
        </div>
        <div class="text-gray-400 text-sm">
            @foreach($premier['genres'] as $genre)
                {{ $genre['genre'] }}@if (!$loop->last), @endif
            @endforeach
        </div>
    </div>
</div>
