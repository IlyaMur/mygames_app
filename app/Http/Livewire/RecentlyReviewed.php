<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Data\GameDataCollection;
use Illuminate\Support\Facades\Http;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviewed()
    {
        $recentlyReviewed = cache()->remember('recently-reviewed', 7, function () {
            return Http::withHeaders(config('services.igdb.keys'))->withBody(
                "
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, rating_count, summary, slug;
                where platforms = (48,49,130,6) 
                & (first_release_date >= " . now()->subMonths(6)->timestamp . "
                & first_release_date < " . now()->timestamp . "
                & rating_count > 5);
                sort total_rating_count desc;
                limit 3;
            ",
                'text/plain'
            )->post(config('services.igdb.url'))->json();
        });

        $this->recentlyReviewed = GameDataCollection::create($recentlyReviewed);
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
