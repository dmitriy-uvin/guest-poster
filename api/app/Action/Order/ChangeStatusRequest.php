<?php

declare(strict_types=1);

namespace App\Action\Order;

final class ChangeStatusRequest
{
    private int $orderId;
    private string $status;

    public function __construct(int $orderId, string $status)
    {
        $this->orderId = $orderId;
        $this->status = $status;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
