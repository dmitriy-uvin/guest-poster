<?php

declare(strict_types=1);

namespace App\Action\User;

final class ChangeUserBlockStatusByIdRequest
{
    private int $id;
    private bool $blockStatus;

    public function __construct(int $id, bool $blockStatus)
    {
        $this->id = $id;
        $this->blockStatus = $blockStatus;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBlockStatus(): bool
    {
        return $this->blockStatus;
    }
}
