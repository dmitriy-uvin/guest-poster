<?php


namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use App\Exceptions\ErrorCode;

class InvalidOrExpiredTokenException extends BaseException
{
    protected $code = ErrorCode::INVALID_OR_EXPIRED_TOKEN;
    protected $message = "Invalid or expired reset password token!";
}
