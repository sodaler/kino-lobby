<div class="mt-8">
    <a href="{{ route('movies.show', $popularMovie['filmId']) }}">
        <img src="{{ $popularMovie['posterUrl'] }}" alt="parasite" class="hover:opacity-75 transition object-cover
                        ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="{{ route('movies.show', $popularMovie['filmId']) }}" class="text-lg mt-2 hover:text-gray-300">
            {{ $popularMovie['nameRu'] }}
        </a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <svg class="fill-current text-orange-500 w-4" width="24" height="24" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
            <span class="ml-1">{{ $popularMovie['rating'] }}</span>
            <span class="mx-2">|</span>
            <span>{{ $popularMovie['year'] }}</span>
        </div>
        <div class="text-gray-400 text-sm">
            @foreach($popularMovie['genres'] as $genre)
                {{ $genre['genre'] }}@if (!$loop->last), @endif
            @endforeach
        </div>
    </div>
</div>
