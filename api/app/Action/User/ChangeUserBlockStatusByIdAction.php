<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Exceptions\User\UserNotFoundException;
use App\Models\User;

final class ChangeUserBlockStatusByIdAction
{
    public function execute(ChangeUserBlockStatusByIdRequest $request)
    {
        $user = User::find($request->getId());

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        $user->blocked = $request->getBlockStatus();
        $user->save();
    }
}
