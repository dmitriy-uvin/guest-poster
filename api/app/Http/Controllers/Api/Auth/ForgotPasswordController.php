<?php

namespace App\Http\Controllers\Api\Auth;

use App\Action\Auth\ResetPasswordAction;
use App\Action\Auth\ResetPasswordRequest;
use App\Action\Auth\SendLinkForgotPasswordAction;
use App\Action\Auth\SendLinkForgotPasswordRequest;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordHttpRequest;
use Illuminate\Http\Request;

class ForgotPasswordController extends ApiController
{
    private SendLinkForgotPasswordAction $sendLinkForgotPasswordAction;
    private ResetPasswordAction $resetPasswordAction;

    public function __construct(
        SendLinkForgotPasswordAction $sendLinkForgotPasswordAction,
        ResetPasswordAction $resetPasswordAction
    ) {
        $this->sendLinkForgotPasswordAction = $sendLinkForgotPasswordAction;
        $this->resetPasswordAction = $resetPasswordAction;
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $this->sendLinkForgotPasswordAction->execute(
            new SendLinkForgotPasswordRequest(
                $request->email
            )
        );

        return $this->emptyResponse();
    }

    public function resetPassword(ResetPasswordHttpRequest $request)
    {
        $this->resetPasswordAction->execute(
            new ResetPasswordRequest(
                $request->email,
                $request->password,
                $request->token
            )
        );

        return $this->emptyResponse();
    }
}
