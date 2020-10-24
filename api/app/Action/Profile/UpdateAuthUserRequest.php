<?php

declare(strict_types=1);

namespace App\Action\Profile;

final class UpdateAuthUserRequest
{
    private ?string $name;
    private ?string $skype;
    private ?string $website;

    public function __construct(
        ?string $name,
        ?string $skype,
        ?string $website
    ) {
          $this->name = $name;
          $this->skype = $skype;
          $this->website = $website;
    }

    public function getName(): ?string
    {
        return $this->name;
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
