<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GifRepository;
use App\Models\Gif;

/**
 * Class GifRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class GifRepositoryEloquent extends BaseRepository implements GifRepository
{
    public function model()
    {
        return Gif::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getRecents(): array
    {
        return $this
            ->select('search', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('search')
            ->values()
            ->toArray();
    }

    public function getBySearchAndEndpoint(string $search, string $endpoint): ?Gif
    {
        return $this->findWhere([
            'search' => $search,
            'endpoint' => $endpoint,
        ])->first();
    }

    public function removeBySearch(string $search): void
    {
        $this->deleteWhere([
            'search' => $search,
        ]);
    }
}
