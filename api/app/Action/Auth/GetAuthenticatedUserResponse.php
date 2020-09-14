<?php

declare(strict_types=1);

namespace App\Action\Auth;

final class GetAuthenticatedUserResponse
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
