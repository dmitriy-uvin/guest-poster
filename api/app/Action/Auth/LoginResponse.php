<?php

declare(strict_types=1);

namespace App\Action\Auth;

final class LoginResponse
{
    private string $token;
    private string $tokenType;
    private int $expiresIn;

    public function __construct(string $token, string $tokenType, int $expiresIn)
    {
        $this->token = $token;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }
}
