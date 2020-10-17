<?php

declare(strict_types=1);

namespace App\Exceptions\Order;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderNotFoundException extends ModelNotFoundException
{
    protected $message = "Order not found!";
}
