<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ViewGameTest extends TestCase
{
    public function testGamePageShowsCorrectGameInfo()
    {
        $response = json_decode(
            file_get_contents(dirname(__DIR__) . '/__fixtures__/' . 'singleGameResponse.json')
        );

        Http::fake([
            config('services.igdb.url') => $response
        ]);
        
        $this->get(route('games.show', 'fake-animal-crossing-new-horizons'))
            ->assertSuccessful()
            ->assertSee('Fake Animal Crossing: New Horizons')
            ->assertSee('Simulator')
            ->assertSee('Nintendo')
            ->assertSee('Switch')
            ->assertSee(90)
            ->assertSee(83)
            ->assertSee('twitter.com/animalcrossing')
            ->assertSee('Escape to a deserted island')
            ->assertSee('//images.igdb.com/igdb/image/upload/t_screenshot_big/sc6lt7.jpg')
            ->assertSee('The Last Journey');
    }
}
