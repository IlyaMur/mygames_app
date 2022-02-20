<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Data\GameDataCollection;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search = '';
    public $searchResults = [];
    
    public function render()
    {
        if (strlen($this->search) > 2) {
            $searchResults = Http::withHeaders(config('services.igdb.keys'))->withBody(
                "search \"{$this->search}\";
            fields name, cover.url, slug;
            limit 6;",
                'text/plain'
            )->post(config('services.igdb.url'))->json();

            $this->searchResults = GameDataCollection::create($searchResults);
        }

        return view('livewire.search-dropdown');
    }
}
