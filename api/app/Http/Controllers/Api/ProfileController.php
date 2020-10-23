<?php

namespace App\Http\Controllers\Api;

use App\Action\Profile\UpdateAuthUserAction;
use App\Action\Profile\UpdateAuthUserRequest;
use App\Http\Presenters\User\UserPresenter;
use App\Http\Requests\Profile\UpdateAuthUserHttpRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends ApiController
{
    private UserPresenter $userPresenter;
    private UpdateAuthUserAction $updateAuthUserAction;

    public function __construct(
        UserPresenter $userPresenter,
        UpdateAuthUserAction $updateAuthUserAction
    ) {
        $this->userPresenter = $userPresenter;
        $this->updateAuthUserAction = $updateAuthUserAction;
    }

    public function updateAuthUser(UpdateAuthUserHttpRequest $request): JsonResponse
    {
        $response = $this->updateAuthUserAction->execute(
            new UpdateAuthUserRequest(
                $request->name,
                $request->skype,
                $request->website,
            )
        );

        return $this->successResponse($this->userPresenter->present(
            $response->getUser()
        ));
    }
}
