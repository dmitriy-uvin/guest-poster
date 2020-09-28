<?php

declare(strict_types=1);

namespace App\Action\Order;

use App\Repositories\Order\Criterion\UserIdCriterion;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class GetOrderCollectionByAuthUserAction
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute()
    {
        $criteria = [new UserIdCriterion(Auth::id())];

        $orders = $this->orderRepository->findByCriteria(...$criteria);

        return new GetOrderCollectionByAuthUserResponse($orders);
    }
}
