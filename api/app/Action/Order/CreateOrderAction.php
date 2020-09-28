<?php

declare(strict_types=1);

namespace App\Action\Order;

use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class CreateOrderAction
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(CreateOrderRequest $request)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->type = $request->getType();
        $order->comment = $request->getComment();
        $order = $this->orderRepository->save($order);

        $orderItems = [];
        foreach ($request->getPlatformIds() as $platformId) {
            $orderItems[] = [
                "order_id" => $order->id,
                "platform_id" => $platformId
            ];
        }
        $order->orderItems()->createMany($orderItems);
        
    }
}
