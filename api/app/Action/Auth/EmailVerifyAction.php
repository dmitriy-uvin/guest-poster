<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Exceptions\User\UserEmailAlreadyVerifiedException;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

final class EmailVerifyAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(EmailVerifyRequest $request)
    {
        $user = $this->userRepository->getById($request->getId());

        if (Hash::check($request->getHash(), sha1($user->email))) {
            throw new AuthenticationException();
        }

        if (!$user->hasVerifiedEmail()) {
            $this->userRepository->markUserEmail($user);
        } else {
            throw new UserEmailAlreadyVerifiedException();
        }
    }
}
