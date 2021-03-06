<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Data\GameDataCollection;
use Illuminate\Support\Facades\Http;

class PopularGames extends Component
{
    public $popularGames = [];

    public function loadPopularGames()
    {
        $popularGames = cache()->remember('popular-games', 7, function () {
            return Http::withHeaders(config('services.igdb.keys'))->withBody(
                "fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, slug;
                where platforms = (48,49,130,6)
                & (first_release_date >= " . now()->subYear()->timestamp . "
                & first_release_date < " . now()->subWeek()->timestamp . "
                & total_rating_count > 5);
                sort total_rating_count desc;
                limit 12;",
                'text/plain'
            )->post(config('services.igdb.url'))->json();
        });

        $this->popularGames = GameDataCollection::create($popularGames);

        collect($this->popularGames)
            ->each(fn ($game) => $this->emit(
                'gamesRatings',
                ['rating' => $game->rating / 100, 'slug' => $game->slug]
            ));
    }

    public function render()
    {
        return view('livewire.popular-games');
    }
}
