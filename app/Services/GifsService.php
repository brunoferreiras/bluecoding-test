<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GifsService
{
    public function search(string $search, int $page): array
    {
        $key = config('services.ghify.key');
        $url = "https://api.giphy.com/v1/gifs/search?api_key={$key}&q={$search}&limit=25&offset={$page}&rating=g&lang=en";
        $response = Http::get($url);
        $data = $response->json('data');
        return $data;
    }
}
