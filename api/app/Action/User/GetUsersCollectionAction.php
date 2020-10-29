<?php

namespace App\Action\User;

use App\Action\PaginatedResponse;
use App\Models\Constants\UserRoles;
use App\Models\User;
use App\Repositories\User\UserRepository;

final class GetUsersCollectionAction
{
    public function execute(GetUsersCollectionRequest $request)
    {
        $page = $request->getPage() ?: UserRepository::DEFAULT_PAGE;
        $perPage = $request->getPerPage() ?: UserRepository::DEFAULT_PER_PAGE;
        $sorting = $request->getSorting() ?: UserRepository::DEFAULT_SORTING;
        $direction = $request->getDirection() ?: UserRepository::DEFAULT_DIRECTION;

        $users = User::where('role', '=', UserRoles::USER);


        $paginator = $users->orderBy($sorting, $direction)
            ->paginate(
                $perPage, ['*'], null, $page
            );

        return new PaginatedResponse($paginator);
    }
}
