<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\PaginatedResponse;
use App\Repositories\Platform\PlatformRepository;
use App\Repositories\Platform\PlatformRepositoryInterface;

final class GetPlatformCollectionAction
{
    private PlatformRepositoryInterface $platformRepository;

    public function __construct(PlatformRepositoryInterface $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    public function execute(GetPlatformCollectionRequest $request)
    {
        $platforms = $this->platformRepository->getAllPaginated(
            $request->getPage() ?: PlatformRepository::DEFAULT_PAGE,
            $request->getPerPage() ?: PlatformRepository::DEFAULT_PER_PAGE,
            $request->getSorting() ?: PlatformRepository::DEFAULT_SORTING,
            $request->getDirection() ?: PlatformRepository::DEFAULT_DIRECTION
        );

        return new PaginatedResponse($platforms);
    }
}
