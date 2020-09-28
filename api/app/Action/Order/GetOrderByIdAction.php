<?php

declare(strict_types=1);

namespace App\Action\Order;

use App\Exceptions\Order\OrderNotFoundException;
use App\Repositories\Order\OrderRepositoryInterface;

final class GetOrderByIdAction
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(GetOrderByIdRequest $request)
    {
        $order = $this->orderRepository->getById($request->getId());

        if (is_null($order)) {
            throw new OrderNotFoundException();
        }

        return new GetOrderByIdResponse($order);
    }
}
