<?php

declare(strict_types=1);

namespace App\Http\Presenters\User;

use App\Http\Presenters\Contracts\PresenterCollectionInterface;
use App\Models\User;
use Illuminate\Support\Collection;

final class UserPresenter implements PresenterCollectionInterface
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
            'email_verified_at' => $user->email_verified_at,
            'blocked' => $user->blocked
        ];
    }

    public function presentCollection(Collection $collection)
    {
        return $collection->map(function ($user) {
           return $this->present($user);
        });
    }
}
