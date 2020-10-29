<?php

namespace App\Action\Filter;

use App\Exceptions\Filter\FilterNotFoundException;
use App\Exceptions\Filter\FilterWithSuchNameAlreadyExistsException;
use App\Models\Filter;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class RenameFilterByIdAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(RenameFilterByIdRequest $request)
    {
        $filter = Filter::find($request->getId());
        $user = $this->userRepository->getById(Auth::id());

        if (is_null($filter)) {
            throw new FilterNotFoundException();
        }

        if (!is_null($user->filters->where('name', '=', $request->getName())->first())) {
            throw new FilterWithSuchNameAlreadyExistsException();
        }

        $filter->name = $request->getName();
        $filter->save();

        return new RenameFilterByIdResponse($filter);
    }
}
