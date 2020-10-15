<?php

declare(strict_types=1);

namespace App\Exceptions\Import;

use App\Exceptions\BaseException;

class ImportException extends BaseException
{
    protected $message = "Something went wrong whyle import!";
}
