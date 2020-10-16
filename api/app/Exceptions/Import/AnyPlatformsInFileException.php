<?php

namespace App\Exceptions\Import;

use App\Exceptions\BaseException;

class AnyPlatformsInFileException extends BaseException
{
    protected $message = "Any platforms in file!";
}
