<?php

namespace App\Http\Controllers\Api\Auth;

use App\Action\Auth\EmailVerifyAction;
use App\Action\Auth\EmailVerifyRequest;
use App\Action\Auth\SendEmailVerifyAction;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends ApiController
{
    private SendEmailVerifyAction $sendEmailVerifyAction;
    private EmailVerifyAction $emailVerifyAction;

    public function __construct(
        SendEmailVerifyAction $sendEmailVerifyAction,
        EmailVerifyAction $emailVerifyAction
    ) {
        $this->sendEmailVerifyAction = $sendEmailVerifyAction;
        $this->emailVerifyAction = $emailVerifyAction;
    }

    public function sendEmailVerification(): JsonResponse
    {
        $this->sendEmailVerifyAction->execute();

        return $this->emptyResponse();
    }

    public function verifyEmail(Request $request): JsonResponse
    {
        $this->emailVerifyAction->execute(
            new EmailVerifyRequest(
                $request->id,
                $request->hash
            )
        );

        return $this->emptyResponse();
    }
}
