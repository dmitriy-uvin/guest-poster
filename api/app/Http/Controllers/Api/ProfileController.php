<?php

namespace App\Http\Controllers\Api;

use App\Action\Profile\UpdateAuthUserAction;
use App\Action\Profile\UpdateAuthUserPasswordAction;
use App\Action\Profile\UpdateAuthUserPasswordRequest;
use App\Action\Profile\UpdateAuthUserRequest;
use App\Http\Presenters\User\UserPresenter;
use App\Http\Requests\Profile\UpdateAuthUserHttpRequest;
use App\Http\Requests\Profile\UpdateAuthUserPasswordHttpRequest;
use Illuminate\Http\JsonResponse;

final class ProfileController extends ApiController
{
    private UserPresenter $userPresenter;
    private UpdateAuthUserAction $updateAuthUserAction;
    private UpdateAuthUserPasswordAction $updateAuthUserPasswordAction;

    public function __construct(
        UserPresenter $userPresenter,
        UpdateAuthUserAction $updateAuthUserAction,
        UpdateAuthUserPasswordAction $updateAuthUserPasswordAction
    ) {
        $this->userPresenter = $userPresenter;
        $this->updateAuthUserAction = $updateAuthUserAction;
        $this->updateAuthUserPasswordAction = $updateAuthUserPasswordAction;
    }

    public function updateAuthUser(UpdateAuthUserHttpRequest $request): JsonResponse
    {
        $response = $this->updateAuthUserAction->execute(
            new UpdateAuthUserRequest(
                $request->name,
                $request->skype,
                $request->website,
                $request->email
            )
        );

        return $this->successResponse($this->userPresenter->present(
            $response->getUser()
        ));
    }

    public function updateAuthUserPassword(UpdateAuthUserPasswordHttpRequest $request): JsonResponse
    {
        $this->updateAuthUserPasswordAction->execute(
            new UpdateAuthUserPasswordRequest(
                $request->old_password,
                $request->new_password,
                $request->new_password_confirmation,
            )
        );

        return $this->emptyResponse();
    }
}
