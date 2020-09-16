<?php

declare(strict_types=1);

namespace App\Repositories\Platform;

use App\Models\Platform;

interface PlatformRepositoryInterface
{
    public function getById(int $id): Platform;
    public function save(Platform $platform): Platform;
    public function delete(Platform $platform): void;
}
