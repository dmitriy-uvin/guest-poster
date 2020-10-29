<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;

final class UserRepository implements UserRepositoryInterface
{
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_PER_PAGE = 5;
    public const DEFAULT_SORTING = 'id';
    public const DEFAULT_DIRECTION = 'desc';


    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    public function getByEmail(string $email): ?User
    {
        return User::firstWhere('email', $email);
    }

    public function save(User $user): User
    {
        $user->save();
        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }

    public function markUserEmail(User $user): void
    {
        $user->markEmailAsVerified();
    }
}
