<?php

declare(strict_types=1);

namespace App\Action\Order;

use App\Repositories\Order\OrderRepositoryInterface;

final class GetAllOrdersAction
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute()
    {
        return new GetAllOrdersResponse($this->orderRepository->getAll());
    }
}
