<?php

declare(strict_types=1);

namespace App\Action\Order;

use Illuminate\Support\Collection;

final class GetAllOrdersResponse
{
    private Collection $orders;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }
}
