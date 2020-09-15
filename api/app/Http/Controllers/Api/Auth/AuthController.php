<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Action\Auth\SendEmailVerifyAction;
use App\Action\Auth\GetAuthenticatedUserAction;
use App\Action\Auth\LoginAction;
use App\Action\Auth\LoginRequest;
use App\Action\Auth\LogOutAction;
use App\Action\Auth\RegisterAction;
use App\Action\Auth\RegisterRequest;
use App\Http\Controllers\Api\ApiController;
use App\Http\Presenters\User\UserPresenter;
use App\Http\Requests\Auth\LoginFormHttpRequest;
use App\Http\Requests\Auth\RegisterFormHttpRequest;
use Illuminate\Http\JsonResponse;

final class AuthController extends ApiController
{
    private UserPresenter $userPresenter;
    private LoginAction $loginAction;
    private LogOutAction $logOutAction;
    private GetAuthenticatedUserAction $getAuthenticatedUserAction;
    private RegisterAction $registerAction;

    public function __construct(
        UserPresenter $userPresenter,
        LoginAction $loginAction,
        LogOutAction $logOutAction,
        RegisterAction $registerAction,
        GetAuthenticatedUserAction $getAuthenticatedUserAction
    ) {
        $this->userPresenter = $userPresenter;
        $this->loginAction = $loginAction;
        $this->logOutAction = $logOutAction;
        $this->registerAction = $registerAction;
        $this->getAuthenticatedUserAction = $getAuthenticatedUserAction;
    }

    public function login(LoginFormHttpRequest $request): JsonResponse
    {
        $response = $this->loginAction->execute(
            new LoginRequest(
                $request->email,
                $request->password
            )
        );

        return $this->successResponse([
            'access_token' => $response->getToken(),
            'token_type' => $response->getTokenType(),
            'expires_in' => $response->getExpiresIn(),
        ]);
    }

    public function register(RegisterFormHttpRequest $request)
    {
        $response = $this->registerAction->execute(
            new RegisterRequest(
                $request->name,
                $request->email,
                $request->password,
                $request->skype,
                $request->website,
            )
        );

        return $this->successResponse($this->userPresenter->present(
            $response->getUser()
        ));
    }

    public function logout(): JsonResponse
    {
        $this->logOutAction->execute();

        return $this->emptyResponse();
    }

    public function me(): JsonResponse
    {
        $response = $this->getAuthenticatedUserAction->execute();
        return $this->successResponse($this->userPresenter->present($response->getUser()));
    }
}
