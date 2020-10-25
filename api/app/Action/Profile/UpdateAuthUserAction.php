<?php

declare(strict_types=1);

namespace App\Action\Profile;

use App\Exceptions\User\UserSuchEmailIsExistsException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class UpdateAuthUserAction
{
    public function execute(UpdateAuthUserRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->getName() ?: $user->name;
        $user->skype = $request->getSkype();
        $user->website = $request->getWebsite();

        if ($user->email !== $request->getEmail()) {
            if (!is_null(User::where('email', '=', $request->getEmail())->get()->first())) {
                throw new UserSuchEmailIsExistsException();
            }

            $user->email = $request->getEmail();
            $user->email_verified_at = null;
        }

        $user->save();

        return new UpdateAuthUserResponse($user);
    }
}
