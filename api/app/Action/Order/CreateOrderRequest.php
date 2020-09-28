<?php

declare(strict_types=1);

namespace App\Action\Order;

final class CreateOrderRequest
{
    private string $type;
    private array $platformIds;
    private ?string $comment;

    public function __construct(
        string $type,
        array $platformIds,
        ?string $comment
    ) {
        $this->type = $type;
        $this->platformIds = $platformIds;
        $this->comment = $comment;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPlatformIds(): array
    {
        return $this->platformIds;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}
