<?php

namespace App\Exceptions\Filter;

use App\Exceptions\BaseException;

class CannotDeleteDefaultFilterException extends BaseException
{
    protected $message = "Cannot delete default filter!";
}
