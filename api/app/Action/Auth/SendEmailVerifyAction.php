<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Notifications\VerifyEmailNotification;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class SendEmailVerifyAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute()
    {
        $user = $this->userRepository->getById(Auth::id());
        $user->notify(new VerifyEmailNotification());
    }
}
