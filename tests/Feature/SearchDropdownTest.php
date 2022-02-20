<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\ComingSoon;
use App\Http\Livewire\PopularGames;
use App\Http\Livewire\SearchDropdown;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchDropdownTest extends TestCase
{
    public function testSearchDropdown()
    {
        $response = json_decode(
            file_get_contents(dirname(__DIR__) . '/__fixtures__/' . 'dropdownSearchResponse.json')
        );

        Http::fake([
            config('services.igdb.url') => Http::response($response)
        ]);

        Livewire::test(SearchDropdown::class)
            ->assertDontSee('Halo')
            ->set('search', 'Halo')
            ->assertSee('Halo: Combat Evolved Anniversary');
    }
}
