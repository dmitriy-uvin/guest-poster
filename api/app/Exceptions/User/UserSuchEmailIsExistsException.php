<?php


namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use App\Exceptions\ErrorCode;

class UserSuchEmailIsExistsException extends BaseException
{
    protected $code = ErrorCode::EMAIL_IS_ALREADY_EXISTS;
    protected $message = "User with such email is already exists!";
}
