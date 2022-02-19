<?php
namespace App\Data;

class GameDataCollection
{
    public static function create(array $data)
    {
        return collect($data)->map(function ($game) {
            return GameData::fromApi($game);
        });
    }
}
