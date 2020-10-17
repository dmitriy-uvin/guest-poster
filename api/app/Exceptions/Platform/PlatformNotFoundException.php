<?php

declare(strict_types=1);

namespace App\Exceptions\Platform;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class PlatformNotFoundException extends ModelNotFoundException
{
    public function __construct($message = "Platform not found!", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
