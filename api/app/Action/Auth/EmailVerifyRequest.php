<?php

declare(strict_types=1);

namespace App\Action\Auth;

final class EmailVerifyRequest
{
    private int $id;
    private string $hash;

    public function __construct(int $id, string $hash)
    {
        $this->id = $id;
        $this->hash = $hash;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}
