<?php

declare(strict_types=1);

namespace App\Http\Presenters\OrderItem;

use App\Http\Presenters\Platform\PlatformPresenter;
use App\Models\OrderItem;
use Illuminate\Support\Collection;

final class OrderItemPresenter
{
    private PlatformPresenter $platformPresenter;

    public function __construct(PlatformPresenter $platformPresenter)
    {
        $this->platformPresenter = $platformPresenter;
    }

    public function presentCollection(Collection $collection)
    {
        return $collection->map(function ($orderItem) {
            return $this->present($orderItem);
        })->toArray();
    }

    public function present(OrderItem $orderItem)
    {
        return [
            $this->platformPresenter->present($orderItem->platform)
        ];
    }

    public function presentArray(array $orderItems)
    {
        $result = [];
        foreach ($orderItems as $orderItem) {
            $result[] = $this->present(OrderItem::find($orderItem['id']));
        }
        return $result;
    }
}
