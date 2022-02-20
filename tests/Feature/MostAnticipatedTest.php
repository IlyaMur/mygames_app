<?php

namespace Tests\Feature;

use App\Http\Livewire\MostAnticipated;
use App\Http\Livewire\PopularGames;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class MostAnticipatedTest extends TestCase
{
    public function testMainPageShowMostAnticipatedGames()
    {
        $response = json_decode(
            file_get_contents(dirname(__DIR__) . '/__fixtures__/' . 'mostAnticipatedResponse.json')
        );

        Http::fake([
            config('services.igdb.url') => Http::response($response)
        ]);

        Livewire::test(MostAnticipated::class)
            ->assertSet('mostAnticipated', [])
            ->call('loadMostAnticipated')
            ->assertSee('Taikou Risshiden')
            ->assertSee('Citywars Tower Defense')
            ->assertSee('Socialize: Poly');
    }
}
