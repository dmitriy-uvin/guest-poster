<?php

namespace App\Http\Presenters\Auth;

use App\Models\User;

final class AuthPresenter
{
    public function present(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'skype' => $user->skype,
            'website' => $user->website,
            'role' => $user->role,
            'email_verified_at' => $user->email_verified_at
        ];
    }
}
