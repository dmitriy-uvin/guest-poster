<?php

declare(strict_types=1);

namespace App\Action\Order;

use App\Models\Order;

final class GetOrderByIdResponse
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}
