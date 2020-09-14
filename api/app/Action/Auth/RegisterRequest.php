<?php

declare(strict_types=1);

namespace App\Action\Auth;

final class RegisterRequest
{
    private string $name;
    private string $email;
    private string $password;
    private ?string $skype;
    private ?string $website;

    public function __construct(
        string $name,
        string $email,
        string $password,
        ?string $skype,
        ?string $website
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->skype = $skype;
        $this->website = $website;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSkype(): ?string
    {
        return $this->skype;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }
}
