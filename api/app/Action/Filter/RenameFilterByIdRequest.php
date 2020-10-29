<?php

namespace App\Action\Filter;

final class RenameFilterByIdRequest
{
    private string $name;
    private int $id;

    public function __construct(string $name, int $id)
    {
        $this->name = trim($name);
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
