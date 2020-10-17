<?php

namespace App\Exceptions\Platform;

use App\Exceptions\BaseException;

class PlatformAlreadyExistsException extends BaseException
{
    protected $message = "Such platform already exists!";
}
