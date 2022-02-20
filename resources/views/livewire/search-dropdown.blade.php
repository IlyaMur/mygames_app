<div class="relative">
    <input wire:model.debounce.300ms="search" type="text"
        class="bg-gray-800 text-sm rounded-full px-3 pl-8 focus:outline-none focus:ring focus:ring-indigo-600 w-64 py-1"
        placeholder="Search...">

    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-400 w-4" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
        </svg>
    </div>

    <div wire:loading class="bottom-0 right-0 mr-4 mt-3 absolute">
        render..
    </div>

    <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2">
        @if (count($searchResults) > 0)
            <ul>
                @foreach ($searchResults as $game)
                    <li class="border-b border-gray-700">
                        <a href="{{ route('games.show', $game->slug) }}"
                            class="hover:bg-gray-700 px-3 py-3 space-x-3 flex transition ease-in-out duration-150">
                            <img class="w-10" src="{{ $game->cover_image_url }}" alt="cover">
                            <span class="mt-4">{{ $game->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            @if ($search !== '')
                <div class="px-3 py-3">No results for {{ $search }}</div>
            @endif
        @endempty
</div>
</div>
