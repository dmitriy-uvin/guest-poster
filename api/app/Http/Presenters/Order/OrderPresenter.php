<?php

declare(strict_types=1);

namespace App\Http\Presenters\Order;

use App\Http\Presenters\OrderItem\OrderItemPresenter;
use App\Http\Presenters\User\UserPresenter;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Support\Collection;

final class OrderPresenter
{
    private OrderItemPresenter $orderItemPresenter;
    private UserPresenter $userPresenter;

    public function __construct(
        OrderItemPresenter $orderItemPresenter,
        UserPresenter $userPresenter
    ) {
        $this->orderItemPresenter = $orderItemPresenter;
        $this->userPresenter = $userPresenter;
    }

    public function presentCollection(Collection $collection) {
        return $collection->map(function ($order) {
            return $this->present($order);
        })->toArray();
    }

    public function present(Order $order) {
        $totalPrice = $order->orderItems->reduce(
            function($sum, $orderItem) {
                return $sum + $orderItem->platform->price
                    + $orderItem->platform->article_writing_price
                    + $orderItem->platform->niche_edit_link_price;
            });

        return [
            "id" => $order->id,
            "type" => $order->type,
            "order_status" => $order->status,
            "comment" => $order->comment,
            "user" => [
                "id" => $order->user->id,
                "name" => $order->user->name,
                "email" => $order->user->email,
                "skype" => $order->user->skype,
                "website" => $order->user->website,
            ],
            "created_at" => $order->created_at,
            "total_price" => $totalPrice,
            "items" => $this->orderItemPresenter->presentCollection(
                $order->orderItems
            )
        ];
    }

    public function presentSortedOrderItems(Order $order, string $sorting, string $direction)
    {
        $totalPrice = $order->orderItems->reduce(
            function($sum, $orderItem) {
                return $sum + $orderItem->platform->price
                    + $orderItem->platform->article_writing_price
                    + $orderItem->platform->niche_edit_link_price;
            });

        return [
            "id" => $order->id,
            "type" => $order->type,
            "order_status" => $order->status,
            "comment" => $order->comment,
            "user" => [
                "id" => $order->user->id,
                "name" => $order->user->name,
                "email" => $order->user->email,
                "skype" => $order->user->skype,
                "website" => $order->user->website,
            ],
            "created_at" => $order->created_at,
            "total_price" => $totalPrice,
            "items" => $this->orderItemPresenter->presentCollection(
                $order
                    ->orderItems()
                    ->orderBy(Platform::select($sorting)
                        ->whereColumn('order_items.platform_id', 'platforms.id'),
                        $direction)
                    ->get()
            )
        ];
    }


    public function presentArrayOrder($order) {
        $totalPrice = Order::find($order['id'])
            ->orderItems->reduce(
            function($sum, $orderItem) {
                return $sum + $orderItem->platform->price
                    + $orderItem->platform->article_writing_price
                    + $orderItem->platform->niche_edit_link_price;
            });
        return [
            "id" => $order['id'],
            "type" => $order['type'],
            "order_status" => $order['status'],
            "comment" => $order['comment'],
            "user" => $this->userPresenter->present(User::find($order['user']['id'])),
            "created_at" => $order['created_at'],
            "total_price" => $totalPrice,
            "items" => $this->orderItemPresenter->presentCollection(
                Order::find($order['id'])
                    ->orderItems
            ),
        ];
    }
}
