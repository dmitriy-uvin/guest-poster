<?php


namespace App\Exceptions\User;

use App\Exceptions\BaseException;

class WrongOldUserPasswordException extends BaseException
{
    protected $message = "Wrong old password!";
}
