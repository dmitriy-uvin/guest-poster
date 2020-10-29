<?php

namespace App\Action\Platform;

use App\Action\PaginatedResponse;
use App\Models\Platform;
use App\Repositories\Platform\PlatformRepository;
use App\Repositories\Platform\PlatformRepositoryInterface;

final class GetPlatformsNotInTrashAction
{
    private PlatformRepositoryInterface $platformRepository;

    public function __construct(PlatformRepositoryInterface $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    public function execute(GetPlatformsNotInTrashRequest $request)
    {
        $page = $request->getPage() ?: PlatformRepository::DEFAULT_PAGE;
        $perPage = $request->getPerPage() ?: PlatformRepository::DEFAULT_PER_PAGE;
        $sorting = $request->getSorting() ?: PlatformRepository::DEFAULT_SORTING;
        $direction = $request->getDirection() ?: PlatformRepository::DEFAULT_DIRECTION;

        $platforms = Platform::where('in_trash', '=', false);

        $platforms = $platforms
            ->orderBy($sorting, $direction)
            ->paginate(
                $perPage, ['*'], null, $page
            );

        return new PaginatedResponse($platforms);
    }
}
