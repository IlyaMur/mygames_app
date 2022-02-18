<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];

    public function loadMostAnticipated()
    {
        $this->mostAnticipated = cache()->remember('most-anticipated', 7, function () {
            return Http::withHeaders(config('services.igdb.keys'))->withBody(
                "
                fields name, cover.url, first_release_date, total_rating_count, platforms.abbreviation, rating, rating_count, summary, slug;
                where platforms = (48,49,130,6) 
                & (first_release_date >= " . now()->timestamp . "
                & first_release_date < " . now()->addMonths(6)->timestamp . ");
                sort total_rating_count desc;
                limit 4;
            ",
                'text/plain'
            )->post(config('services.igdb.url'))->json();
        });
    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
