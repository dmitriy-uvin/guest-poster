<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Action\ByIdRequest;
use App\Exceptions\User\UserNotFoundException;
use App\Models\User;

final class DeleteUserByIdAction
{
    public function execute(ByIdRequest $request): void
    {
        $user = User::find($request->getId());

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        $user->delete();
    }
}
