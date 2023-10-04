<?php

namespace App\Repositories;

use App\Models\Gif;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface GifRepository.
 *
 * @package namespace App\Repositories;
 */
interface GifRepository extends RepositoryInterface
{
    public function getRecents(): array;

    public function getBySearchAndEndpoint(string $search, string $endpoint): ?Gif;

    public function removeBySearch(string $search): void;
}
