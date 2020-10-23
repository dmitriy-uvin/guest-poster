<?php

declare(strict_types=1);

namespace App\Action\Profile;

use Illuminate\Support\Facades\Auth;

final class UpdateAuthUserAction
{
    public function execute(UpdateAuthUserRequest $request)
    {
        $user = Auth::user();

        if ($request->getName()) {
            $user->name = $request->getName();
        }

        if ($request->getSkype()) {
            $user->skype = $request->getSkype();
        }

        if ($request->getWebsite()) {
            $user->website = $request->getWebsite();
        }
        $user->save();

        return new UpdateAuthUserResponse($user);
    }
}
