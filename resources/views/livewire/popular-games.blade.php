<div wire:init="loadPopularGames"
    class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
    @forelse ($popularGames as $game)
        <x-game-card :game="$game" />
    @empty
        @foreach (range(1, 12) as $game)
            <div class="game mt-6">
                <div class="relative inline-block">
                    <div class="bg-gray-800 w-44 h-56"></div>
                </div>
                <div href="#" class="block w-44 text-transparent text-lg rounded bg-gray-700 mt-4 leading-tight">
                    Title here
                </div>
                <div class="text-gray-400 text-transparent bg-gray-700 inline-block rounded mt-3">
                    PS4, PC, Switch
                </div>
            </div>
        @endforeach
    @endforelse
</div>

@push('scripts')
    @include('partials._rating', [
    'event' => 'gamesRatings'
    ])
@endpush
