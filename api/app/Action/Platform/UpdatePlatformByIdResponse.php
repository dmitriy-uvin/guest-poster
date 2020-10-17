<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Models\Platform;

final class UpdatePlatformByIdResponse
{
    private Platform $platform;

    public function __construct(Platform $platform)
    {
        $this->platform = $platform;
    }

    public function getPlatform(): Platform
    {
        return $this->platform;
    }
}
