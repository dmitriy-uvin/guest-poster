<?php

declare(strict_types=1);

namespace App\Http\Presenters\Order;

use App\Http\Presenters\OrderItem\OrderItemPresenter;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Collection;

final class OrderPresenter
{
    private OrderItemPresenter $orderItemPresenter;

    public function __construct(OrderItemPresenter $orderItemPresenter)
    {
        $this->orderItemPresenter = $orderItemPresenter;
    }

    public function presentCollection(Collection $collection) {
        return $collection->map(function ($order) {
            return $this->present($order);
        })->toArray();
    }

    public function present(Order $order) {
        return [
            "id" => $order->id,
            "type" => $order->type,
            "order_status" => $order->status,
            "user_id" => $order->user->id,
            "items" => $this->orderItemPresenter->presentCollection($order->orderItems)
        ];
    }
}
