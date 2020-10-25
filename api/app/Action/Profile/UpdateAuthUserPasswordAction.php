<?php

namespace App\Action\Profile;

use App\Exceptions\User\PasswordsDontMatchException;
use App\Exceptions\User\WrongOldUserPasswordException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class UpdateAuthUserPasswordAction
{
    public function execute(UpdateAuthUserPasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->getOldPassword(), $user->password)) {
            throw new WrongOldUserPasswordException();
        }

        if ($request->getNewPassword() !== $request->getNewPasswordConfirmation()) {
            throw new PasswordsDontMatchException();
        }

        $user->password = Hash::make($request->getNewPassword());
        $user->save();
    }
}
