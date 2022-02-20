<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\ComingSoon;
use App\Http\Livewire\PopularGames;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComingSoonTest extends TestCase
{
    public function testMainPageShowComingSoonGames()
    {
        $response = json_decode(
            file_get_contents(dirname(__DIR__) . '/__fixtures__/' . 'comingSoonResponse.json')
        );

        Http::fake([
            config('services.igdb.url') => $response
        ]);

        Livewire::test(ComingSoon::class)
            ->assertSet('comingSoon', [])
            ->call('loadComingSoon')
            ->assertSee("Mr. Rainer's Solve-It Service")
            ->assertSee("Destiny 2: The Witch Queen")
            ->assertSee('SCP: Pandemic');
    }
}
