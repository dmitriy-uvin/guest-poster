<?php

declare(strict_types=1);

namespace App\Action\Order;

final class GetOrderByIdRequest
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
