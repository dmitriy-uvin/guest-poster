<?php


namespace App\Action\Auth;

use App\Exceptions\User\InvalidOrExpiredTokenException;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

final class ResetPasswordAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(ResetPasswordRequest $request)
    {
        $credentials = [
            'email' => $request->getEmail(),
            'password' => Hash::make($request->getPassword()),
            'token' => $request->getToken()
        ];

        $resetPasswordStatus = Password::reset(
            $credentials,
            function ($user, $password) {
                $user->password = $password;
                $this->userRepository->save($user);
            }
        );

        if ($resetPasswordStatus !== Password::PASSWORD_RESET) {
            throw new InvalidOrExpiredTokenException();
        }
    }
}
