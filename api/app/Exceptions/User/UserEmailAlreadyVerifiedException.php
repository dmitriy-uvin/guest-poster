<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use App\Exceptions\ErrorCode;

class UserEmailAlreadyVerifiedException extends BaseException
{
    protected $code = ErrorCode::EMAIL_IS_ALREADY_VERIFIED;
    protected $message = "User email is already verified";
}
