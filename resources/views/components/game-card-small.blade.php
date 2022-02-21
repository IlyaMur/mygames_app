<div class="game flex">
    <a href="{{ route('games.show', $game->slug) }}">
        <img class="w-16 hover:opacity-75 transition ease-in-out duration-150 rounded-lg"
            src="{{ $game->cover_image_url }}">
    </a>
    <div class="ml-4">
        <a href="#" class="hover:text-gray-300">{{ $game->name }}</a>
        <div class="text-gray-400 text-sm mt-1">
            {{ $game->first_release_date }}
        </div>
    </div>
</div>
