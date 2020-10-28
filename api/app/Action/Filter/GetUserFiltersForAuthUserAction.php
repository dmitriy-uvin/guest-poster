<?php

namespace App\Action\Filter;

use App\Exceptions\User\UserNotFoundException;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class GetUserFiltersForAuthUserAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute()
    {
        $user = $this->userRepository->getById(Auth::id());

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        $userFilters = $user->filters;

        return new GetUserFiltersForAuthUserResponse($userFilters);
    }
}
