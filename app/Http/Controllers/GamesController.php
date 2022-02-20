<?php

namespace App\Http\Controllers;

use App\Data\GameData;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $game = Http::withHeaders(config('services.igdb.keys'))
            ->withBody(
                "fields name, cover.url, first_release_date, platforms.abbreviation, rating,
                slug, involved_companies.company.name, genres.name, aggregated_rating, summary, 
                websites.*, videos.*, screenshots.*, similar_games.cover.url, similar_games.name, 
                similar_games.rating,similar_games.platforms.abbreviation, similar_games.slug;
                where slug=\"{$slug}\";",
                'text/plain'
            )
            ->post(config('services.igdb.url'))
            ->json();

        abort_if(!$game, 404);

        $game = GameData::fromApi($game[0]);

        return view('show', [
            'game' => $game
        ]);
    }
}
