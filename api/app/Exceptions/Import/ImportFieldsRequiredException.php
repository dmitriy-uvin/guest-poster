<?php

namespace App\Exceptions\Import;

use App\Exceptions\BaseException;
use Throwable;

final class ImportFieldsRequiredException extends BaseException
{
    public function __construct($field = '', $code = 0, Throwable $previous = null)
    {
        $message = "Field <b>'{$field}'</b> is required!";
        parent::__construct($message, $code, $previous);
    }
}
