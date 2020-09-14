<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use App\Exceptions\ErrorCode;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class UserNotFoundException extends ModelNotFoundException
{
    public function __construct($message = "User not found!", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
