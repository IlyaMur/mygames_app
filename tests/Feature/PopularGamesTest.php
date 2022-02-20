<?php

namespace Tests\Feature;

use App\Http\Livewire\PopularGames;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class PopularGameTest extends TestCase
{
    public function testMainPageShowsPopularGames()
    {
        $response = json_decode(
            file_get_contents(dirname(__DIR__) . '/__fixtures__/' . 'popularGamesResponse.json')
        );

        Http::fake([
            config('services.igdb.url') => Http::response($response)
        ]);

        Livewire::test(PopularGames::class)
            ->assertSet('popularGames', [])
            ->call('loadPopularGames')
            ->assertSee('Fake Twelve Minutes')
            ->assertSee('PC')
            ->assertSee('Kena: Bridge of Spirits');
    }
}
