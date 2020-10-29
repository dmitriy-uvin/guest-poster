<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\ByIdRequest;
use App\Action\User\ChangeUserBlockStatusByIdAction;
use App\Action\User\ChangeUserBlockStatusByIdRequest;
use App\Action\User\DeleteUserByIdAction;
use App\Action\User\GetUserByIdAction;
use App\Action\User\GetUsersCollectionAction;
use App\Action\User\GetUsersCollectionRequest;
use App\Http\Presenters\User\UserPresenter;
use App\Http\Requests\PaginatedHttpRequest;
use App\Http\Requests\User\ChangeUserBlockStatusHttpRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserController extends ApiController
{
    private UserPresenter $userPresenter;
    private GetUsersCollectionAction $getUsersCollectionAction;
    private GetUserByIdAction $getUserByIdAction;
    private DeleteUserByIdAction $deleteUserByIdAction;
    private ChangeUserBlockStatusByIdAction $changeUserBlockStatusByIdAction;

    public function __construct(
        UserPresenter $userPresenter,
        GetUsersCollectionAction $getUsersCollectionAction,
        GetUserByIdAction $getUserByIdAction,
        DeleteUserByIdAction $deleteUserByIdAction,
        ChangeUserBlockStatusByIdAction $changeUserBlockStatusByIdAction
    ) {
        $this->userPresenter = $userPresenter;
        $this->getUsersCollectionAction = $getUsersCollectionAction;
        $this->getUserByIdAction = $getUserByIdAction;
        $this->deleteUserByIdAction = $deleteUserByIdAction;
        $this->changeUserBlockStatusByIdAction = $changeUserBlockStatusByIdAction;
    }

    public function getAllUsers(PaginatedHttpRequest $request): JsonResponse
    {
        $response = $this->getUsersCollectionAction->execute(
            new GetUsersCollectionRequest(
                (int)$request->page,
                (int)$request->perPage,
                $request->sorting,
                $request->direction,
            )
        );

        return $this->createPaginatedResponse(
            $response->getPaginator(),
            $this->userPresenter
        );
    }

    public function getUserById(string $id): JsonResponse
    {
        $response = $this->getUserByIdAction->execute(
            new ByIdRequest((int)$id)
        );

        return $this->successResponse(
            $this->userPresenter->present($response->getUser())
        );
    }

    public function changeUserBlockStatusById(string $id, ChangeUserBlockStatusHttpRequest $request): JsonResponse
    {
        $this->changeUserBlockStatusByIdAction->execute(
            new ChangeUserBlockStatusByIdRequest(
                (int)$id,
                (bool)$request->block_status
            )
        );

        return $this->emptyResponse();
    }

    public function deleteUserById(string $id): JsonResponse
    {
        $this->deleteUserByIdAction->execute(
            new ByIdRequest((int)$id)
        );

        return $this->emptyResponse();
    }
}
