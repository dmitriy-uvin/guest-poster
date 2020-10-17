<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\ByIdRequest;
use App\Exceptions\Platform\PlatformNotFoundException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Platform\PlatformRepositoryInterface;

final class DeletePlatformByIdAction
{
    private PlatformRepositoryInterface $platformRepository;

    public function __construct(PlatformRepositoryInterface $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    public function execute(ByIdRequest $request): void
    {
        $platform = $this->platformRepository->getById($request->getId());

        if (is_null($platform)) {
            throw new PlatformNotFoundException();
        }

        OrderItem::where('platform_id', '=', $platform->id)->delete();
        Order::doesntHave('orderItems')->delete();

        $this->platformRepository->delete($platform);
    }
}
