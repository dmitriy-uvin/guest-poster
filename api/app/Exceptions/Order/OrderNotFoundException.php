<?php

declare(strict_types=1);

namespace App\Exceptions\Order;

use App\Exceptions\BaseException;

class OrderNotFoundException extends BaseException
{
    protected $message = "Order nout found!";
}
