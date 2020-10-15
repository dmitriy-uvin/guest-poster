<?php

declare(strict_types=1);

namespace App\Exceptions\Import;

use App\Exceptions\BaseException;
use Throwable;

final class WrongImportValueException extends BaseException
{
    public function __construct(
        $line = 0,
        $column = "",
        $message = "Wrong value format",
        $code = 404,
        Throwable $previous = null)
    {
        $message = $message . ' at line: ' . $line . ", column: '" . $column . "'";
        parent::__construct($message, $code, $previous);
    }
}
