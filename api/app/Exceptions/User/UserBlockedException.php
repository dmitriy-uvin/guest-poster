<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;

class UserBlockedException extends BaseException
{
    public $message = "Account is blocked!";
}
