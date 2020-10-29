<?php

namespace App\Exceptions\Filter;

use App\Exceptions\BaseException;

class FilterWithSuchNameAlreadyExistsException extends BaseException
{
    protected $message = "Filter with such name already exists";
}
