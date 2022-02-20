<?php

namespace App\Data;

use Illuminate\Support\Collection;

class GameDataCollection
{
    public static function create(array $data): Collection
    {
        return collect($data)
            ->map(fn ($game) => GameData::fromApi($game));
    }
}
