<div wire:init="loadRecentlyReviewed" class="recently-reviewed-container space-y-12 mt-8">
    @forelse ($recentlyReviewed as $game)
        <div class="game bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
            <div class="relative flex-none">
                <a href="#">
                    <img src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="game cover"
                        class="hover:opacity-75 transition ease-in-out duration-150">
                </a>
                @if (isset($game['rating']))
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full"
                        style="right:-20px; bottom: -20px">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            {{ round($game['rating']) . '%' }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="ml-12">
                <a href="#" class="block text-lg font-semibold leading-tight hover:text-gray-400 mt-4">
                    {{ $game['name'] }}</a>
                <div class="text-gray-400 mt-1">
                    {{ implode(', ', array_column($game['platforms'], 'abbreviation')) }}</div>
                <p class="mt-6 text-gray-400 hidden lg:block">{{ $game['summary'] }}</p>
            </div>
        </div>
    @empty
        @foreach (range(1, 3) as $game)
            <div class="game bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
                <div class="relative flex-none">
                    <div class="bg-gray-700 w-32 lg:w-48 h-40 lg:h-56"></div>
                </div>
                <div class="ml-6 lg:ml-12">
                    <div href="#"
                        class="inline-block text-lg font-semibold leading-tight text-transparent bg-gray-700 rounded mt-4">
                        title here</div>
                    <div class="mt-8 space-y-4 hidden lg:block">
                        <div class="text-transparent bg-gray-700 mb-3 rounded">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, corrupti Numquam,
                            corrupti.
                        </div>
                        <div class="text-transparent bg-gray-700 rounded">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, corrupti Numquam,
                            corrupti.
                        </div>
                        <div class="text-transparent bg-gray-700 rounded">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, corrupti Numquam,
                            corrupti.
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>