<div wire:init="loadComingSoon" class="space-y-10 mt-8">
    @forelse ($comingSoon as $game)
        <div class="game flex">
            <a href="#">
                <img src="{{ Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) }}">
            </a>
            <div class="ml-4">
                <a href="#" class="hover:text-gray-300"> {{ $game['name'] }}</a>
                <div class="text-gray-400 text-sm mt-1">
                    {{ Carbon\Carbon::parse($game['first_release_date'])->format('M d, Y') }}
                </div>
            </div>
        </div>
    @empty
        @foreach (range(1, 4) as $game)
            <div class="game flex">
                <div class="bg-gray-700 w-20 h-24 flex-none"></div>
                <div class="ml-4">
                    <div href="#" class="text-transparent bg-gray-700 rounded leading-tight">title here and here</div>
                    <div class="text-gray-400 text-transparent rounded bg-gray-700 inline-block text-sm mt-2">
                        sept 14 2021
                    </div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>
