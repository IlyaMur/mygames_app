<?php

namespace Tests\Feature;

use App\Http\Livewire\PopularGames;
use App\Http\Livewire\RecentlyReviewed;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class RecentlyReviewedTest extends TestCase
{
    public function testMainPageShowRecentlyReviewedGames()
    {
        $response = json_decode(
            file_get_contents(dirname(__DIR__) . '/__fixtures__/' . 'recentlyReviewedResponse.json')
        );

        Http::fake([
            config('services.igdb.url') => $response
        ]);

        Livewire::test(RecentlyReviewed::class)
            ->assertSet('recentlyReviewed', [])
            ->call('loadRecentlyReviewed')
            ->assertSee('Psychonauts 2')
            ->assertSee('Halo Infinite')
            ->assertSee('XONE');
    }
}
