<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Exceptions\User\UserSuchEmailIsExistsException;
use App\Jobs\SendRegisterEmailJob;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

final class RegisterAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(RegisterRequest $request)
    {
        if ($this->userRepository->getByEmail($request->getEmail())) {
            throw new UserSuchEmailIsExistsException();
        }

        $user = new User();
        $user->name = $request->getName();
        $user->password = Hash::make($request->getPassword());
        $user->email = $request->getEmail();
        $user->skype = $request->getSkype();
        $user->website = $request->getWebsite();

        $user = $this->userRepository->save($user);

        SendRegisterEmailJob::dispatch($request->getEmail());

        return new RegisterResponse($user);
    }
}
