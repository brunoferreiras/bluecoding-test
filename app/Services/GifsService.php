<?php

namespace App\Services;

use App\Repositories\GifRepository;
use Illuminate\Support\Facades\Http;

class GifsService
{
    public function __construct(
        protected GifRepository $repository
    ) {
    }

    private function save(string $search, string $endpoint, array $data): void
    {
        $this->repository->create([
            'search' => $search,
            'endpoint' => $endpoint,
            'data' => $data,
        ]);
    }

    private function getGifsFromExternalApi(string $endpoint): array
    {
        $key = config('services.ghify.key');
        $url = "https://api.giphy.com/v1/gifs/search?api_key={$key}{$endpoint}";
        $response = Http::get($url);
        return $response->json('data') ?? [];
    }

    public function search(string $search, int $page): array
    {
        if (empty($search)) {
            return [];
        }
        $endpoint = "&q={$search}&limit=25&offset={$page}&rating=g&lang=en";
        $model = $this->repository->getBySearchAndEndpoint($search, $endpoint);
        if (!empty($model)) {
            return $model->data;
        }
        $data = $this->getGifsFromExternalApi($endpoint);
        $this->save($search, $endpoint, $data);
        return $data;
    }

    public function getRecents(): array
    {
        return $this->repository->getRecents();
    }

    public function removeBySearch(string $search): void
    {
        $this->repository->removeBySearch($search);
    }
}
