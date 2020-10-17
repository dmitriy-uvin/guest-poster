<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\ByIdsRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Platform;

final class DeletePlatformsByIdsAction
{
    public function execute(ByIdsRequest $request)
    {
        foreach ($request->getIds() as $id) {
            OrderItem::where('platform_id', '=', (int)$id)
                ->delete();
            Order::doesntHave('orderItems')->delete();
            Platform::find($id)->delete();
        }
    }
}
