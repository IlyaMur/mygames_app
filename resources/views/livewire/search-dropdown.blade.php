<div class="relative" x-data="{isVisible: true}" @click.away="isVisible = false">

    <input wire:model.debounce.300ms="search" type="text"
        class="bg-gray-800 text-sm rounded-full px-3 pl-8 focus:outline-none focus:ring focus:ring-indigo-600 w-64 py-1"
        placeholder="Search... (Press '/' to focus)" @focus=" isVisible = true"
        @keydown.escape.window="isVisible = false" @keydown=" isVisible = true" @keydown.shift.tab="isVisible = false"
        x-ref="search" @keydown.window="
        if (event.keyCode === 191) {
            event.preventDefault();
            $refs.search.focus();
        }
        ">

    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-400 w-4" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
        </svg>
    </div>

    <div wire:loading class="bottom-1 right-0 mr-4 mt-3 absolute">
        <svg role="status" class="inline mr-2 w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor" />
            <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentFill" />
        </svg>
    </div>

    <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2" x-show.transition.opacity.duration.200="isVisible">
        @if (strlen($search) > 2)
            @if (count($searchResults) > 0)
                <ul>
                    @foreach ($searchResults as $game)
                        <li class="border-b border-gray-700">
                            <a href=" {{ route('games.show', $game->slug) }}"
                                class="hover:bg-gray-700 px-3 py-3 space-x-3 flex transition ease-in-out duration-150"
                                @if ($loop->last) @keydown.tab="isVisible=false" @endif>

                                <img class="w-10" src="{{ $game->cover_image_url }}" alt="cover">
                                <span class="mt-4">{{ $game->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for {{ $search }}</div>
            @endif
        @endif
    </div>
</div>
