<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $before = Carbon::now()->subMonth(6)->timestamp;
        $after = Carbon::now()->addMonth(6)->timestamp;
        $afterFourMonth = Carbon::now()->addMonth(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $popularGames = Http::withHeaders(config('services.igdb.keys'))
        ->withBody(
            "fields name, cover.url, 
             first_release_date, total_rating_count, 
             platforms.abbreviation, rating; 
             where platforms = (48, 49, 130, 6)
             & (first_release_date >= {$before} 
             & first_release_date < {$after})
             & rating > 60; 
             sort rating desc; 
             limit 12;",
            'text/plain'
        )
        ->post(config('services.igdb.url'))
        ->json();

        $recentlyReviewed = Http::withHeaders(config('services.igdb.keys'))
        ->withBody(
            "fields name, cover.url, 
             first_release_date, total_rating_count, 
             platforms.abbreviation, rating_count, 
             rating, summary; 
             where platforms = (48, 49, 130, 6)
             & (first_release_date >= {$before} 
             & first_release_date < {$current})
             & rating_count > 5; 
             sort rating desc; 
             limit 3;",
            'text/plain'
        )
        ->post(config('services.igdb.url'))
        ->json();

        $mostAnticipated = Http::withHeaders(config('services.igdb.keys'))
        ->withBody(
            "fields name, cover.url, 
             first_release_date, total_rating_count, 
             platforms.abbreviation, rating_count, 
             rating, summary; 
             where platforms = (48, 49, 130, 6)
             & (first_release_date >= {$before} 
             & first_release_date < {$afterFourMonth}); 
             sort total_rating_count desc; 
             limit 4;",
            'text/plain'
        )
        ->post(config('services.igdb.url'))
        ->json();

        $comingSoon = Http::withHeaders(config('services.igdb.keys'))
        ->withBody(
            "fields name, cover.url, 
             first_release_date, total_rating_count, 
             platforms.abbreviation, rating_count, 
             rating, summary; 
             where platforms = (48, 49, 130, 6)
             & (first_release_date > {$current}); 
             sort first_release_date asc; 
             limit 4;",
            'text/plain'
        )
        ->post(config('services.igdb.url'))
        ->json();
        
        return view('index', [
            'popularGames' => $popularGames,
            'recentlyReviewed' => $recentlyReviewed,
            'comingSoon' => $comingSoon,
            'mostAnticipated' => $mostAnticipated
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
