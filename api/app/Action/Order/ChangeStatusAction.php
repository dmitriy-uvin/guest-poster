<?php

declare(strict_types=1);

namespace App\Action\Order;

use App\Exceptions\Order\OrderNotFoundException;
use App\Repositories\Order\OrderRepositoryInterface;

final class ChangeStatusAction
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(ChangeStatusRequest $request)
    {
        $order = $this->orderRepository->getById($request->getOrderId());

        if (is_null($order)) {
            throw new OrderNotFoundException();
        }

        $order->status = $request->getStatus();
        $this->orderRepository->save($order);
    }
}
