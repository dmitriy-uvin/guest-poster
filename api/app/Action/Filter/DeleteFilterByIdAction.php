<?php

namespace App\Action\Filter;

use App\Action\ByIdRequest;
use App\Exceptions\Filter\CannotDeleteDefaultFilterException;
use App\Exceptions\Filter\FilterNotFoundException;
use App\Models\Constants\FilterConstants;
use App\Models\Filter;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class DeleteFilterByIdAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(ByIdRequest $request)
    {
        $user = $this->userRepository->getById(Auth::id());
        $filter = Filter::find($request->getId());

        if (is_null($filter)) {
            throw new FilterNotFoundException();
        }

        if ($filter->type === FilterConstants::DEFAULT_TYPE) {
            throw new CannotDeleteDefaultFilterException();
        }

        $user->filters()->detach($filter->id);
        $filter->delete();
    }
}
