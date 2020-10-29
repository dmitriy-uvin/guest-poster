<?php

namespace App\Exceptions\Filter;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class FilterNotFoundException extends ModelNotFoundException
{
    protected $message = "Filter not found!";
}
