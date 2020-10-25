<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;

class PasswordsDontMatchException extends BaseException
{
    protected $message = "Passwords don't match!";
}
