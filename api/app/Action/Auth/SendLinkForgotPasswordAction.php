<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Exceptions\User\UserNotFoundException;
use App\Notifications\ResetPasswordNotification;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Password;

final class SendLinkForgotPasswordAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(SendLinkForgotPasswordRequest $request)
    {
        $user = $this->userRepository->getByEmail($request->getEmail());

        if (!$user) {
            throw new UserNotFoundException();
        }
        $token = Password::createToken($user);

        $user->notify(new ResetPasswordNotification($token));
    }
}
