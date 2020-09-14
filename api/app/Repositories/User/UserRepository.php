<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;

final class UserRepository implements UserRepositoryInterface
{
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
}
