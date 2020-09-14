<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Exceptions\User\UserNotFoundException;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

final class LoginAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(LoginRequest $request)
    {
        $user = $this->userRepository->getByEmail($request->getEmail());

        if (!$user) {
            throw new UserNotFoundException("No exists user for " . $request->getEmail());
        }

        $token = Auth::attempt([
            'email' => $request->getEmail(),
            'password' => $request->getPassword()
        ]);

        if (!$token) {
            throw new AuthenticationException("Invalid password or email");
        }

        return new LoginResponse(
            $token,
            'bearer',
            auth()->factory()->getTTL()
        );
    }
}
