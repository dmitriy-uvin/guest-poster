<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;

class UserBlockedException extends BaseException
{
    protected $message = "Account is blocked!";
}
