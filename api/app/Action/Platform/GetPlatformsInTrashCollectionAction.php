<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\PaginatedResponse;
use App\Models\Platform;
use App\Repositories\Platform\PlatformRepository;

final class GetPlatformsInTrashCollectionAction
{
    public function execute(GetPlatformsInTrashCollectionRequest $request): PaginatedResponse
    {
        $platforms = Platform::where('in_trash', true);

        $page = $request->getPage() ?: PlatformRepository::DEFAULT_PAGE;
        $perPage = $request->getPerPage() ?: PlatformRepository::DEFAULT_PER_PAGE;
        $sorting = $request->getSorting() ?: PlatformRepository::DEFAULT_SORTING;
        $direction = $request->getDirection() ?: PlatformRepository::DEFAULT_DIRECTION;

        $platforms = $platforms
            ->orderBy($sorting, $direction)
            ->paginate(
                $perPage, ['*'], null, $page
            );

        return new PaginatedResponse($platforms);
    }
}
