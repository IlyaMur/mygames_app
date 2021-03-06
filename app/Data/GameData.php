<?php

namespace App\Data;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Support\Collection;

class GameData extends DataTransferObject
{
    /**
     * Defines the resource ID.
     *
     * @var int
     */
    public int $id;

    /**
     * Defines the resource aggregated rating.
     *
     * @var float|int|null
     */
    public ?float $aggregated_rating;

    /**
     * Defines the avaliable covers.
     *
     * @var array
     */
    public ?array $cover;

    /**
     * Defines the cover image URL.
     *
     * @var string
     */
    public ?string $cover_image_url;

    /**
     * Defines the resource first release date.
     *
     * @var \Carbon\Carbon|null
     */
    public ?Carbon $first_release_date;

    /**
     * Defines the resource genres.
     *
     * @var string
     */
    public ?string $genres;

    /**
     * Defines the resource involved companies.
     *
     * @var string|null
     */
    public ?string $involved_companies;

    /**
     * Defines the resource name.
     *
     * @var string
     */
    public ?string $name;

    /**
     * Defines the resource avaliable platforms.
     *
     * @var string|null
     */
    public ?string $platforms;

    /**
     * Defines the resource rating.
     *
     * @var float|int
     */
    public ?float $rating;

    /**
     * Defines the resource screenshots.
     *
     * @var \Illuminate\Support\Collection|null
     */
    public ?Collection $screenshots;

    /**
     * Define the resource similar games.
     *
     * @var \Illuminate\Support\Collection
     */
    public ?Collection $similar_games;

    /**
     * Defines the resource slug.
     *
     * @var string
     */
    public ?string $slug = '';

    /**
     * Define the resource summary.
     *
     * @var string|null
     */
    public ?string $summary;

    /**
     * Defines the resource rating cout.
     *
     * @var int|null
     */
    public ?int $total_rating_count;

    /**
     * Defines the resource videos.
     *
     * @var array|null
     */
    public ?array $videos;

    /**
     * Defines the resource websites.
     *
     * @var array|null
     */
    public ?array $websites;

    /**
     * Defines the resource trailer.
     *
     * @var string|null
     */
    public ?string $trailer;

    /**
     * Defines the resource social media websites.
     *
     * @var array|null
     */
    public ?array $social;

    /**
     * Define the resource rating count.
     *
     * @var int|null
     */
    public ?int $rating_count;

    /**
     * Gets the API response and
     * normalizes.
     *
     * @return self
     */
    public static function fromApi(array $game): self
    {
        $game['cover_image_url'] = isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : asset('img/sample-game-cover.png');
        $game['genres'] = isset($game['genres']) ? implode(', ', collect($game['genres'])->pluck('name')->toArray()) : 'Multiple genres';
        $game['first_release_date'] = isset($game['first_release_date']) ? Carbon::parse($game['first_release_date']) : null;
        
        if (isset($game['involved_companies'])) {
            $game['involved_companies'] = $game['involved_companies'][0]['company']['name'];
        }

        $game['platforms'] = isset($game['platforms']) ? implode(', ', collect($game['platforms'])->pluck('abbreviation')->toArray()) : null;
        $game['rating'] = isset($game['rating']) ? round($game['rating']) : 0;
        $game['aggregated_rating'] = isset($game['aggregated_rating']) ? round($game['aggregated_rating']) : 0;
        $game['trailer'] = isset($game['videos']) ? 'https://youtube.com/embed/' . $game['videos'][0]['video_id'] : null;
        
        if (isset($game['screenshots'])) {
            $game['screenshots'] = collect($game['screenshots'])->map(function ($screenshot) {
                return [
                    'big' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url']),
                    'huge' => isset($screenshot['url']) ? Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']) : asset('images/sample-game-cover.png')
                ];
            })->take(9);
        }

        if (isset($game['similar_games'])) {
            $game['similar_games'] = collect($game['similar_games'])->map(function ($game) {
                return self::fromApi($game);
            })->take(6);
        } else {
            $game['similar_games'] = collect(); // Default value
        }

        if (isset($game['websites'])) {
            $game['social'] = [
                'website' => collect($game['websites'])->first(),
                'facebook' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'facebook');
                })->first(),
                'twitter' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'twitter');
                })->first(),
                'instagram' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'instagram');
                })->first(),
            ];
        }
        
        return new self($game);
    }
}
