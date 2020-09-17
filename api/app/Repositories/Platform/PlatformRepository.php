<?php

declare(strict_types=1);

namespace App\Repositories\Platform;

use App\Models\Platform;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class PlatformRepository implements PlatformRepositoryInterface
{
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_PER_PAGE = 5;
    public const DEFAULT_SORTING = 'created_at';
    public const DEFAULT_DIRECTION = 'desc';

    public function getById(int $id): Platform
    {
        return Platform::find($id);
    }

    public function save(Platform $platform): Platform
    {
        $platform->save();

        return $platform;
    }

    public function delete(Platform $platform): void
    {
        $platform->delete();
    }

    public function saveTopics(Platform $platform,array $topics): void
    {
        $platform
            ->topics()
            ->createMany($topics);
    }

    public function getAll(): Collection
    {
        return Platform::all();
    }

    public function getAllPaginated(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sorting = self::DEFAULT_SORTING,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        $query = Platform::query();

        return $query
            ->orderBy($sorting, $direction)
            ->paginate(
                $perPage, ['*'], null, $page
            );
    }
}
