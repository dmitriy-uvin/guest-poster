<?php

declare(strict_types=1);

namespace App\Repositories\Platform;

use App\Models\Platform;
use Illuminate\Support\Collection;

interface PlatformRepositoryInterface
{
    public function getById(int $id): Platform;
    public function save(Platform $platform): Platform;
    public function delete(Platform $platform): void;
    public function saveTopics(Platform $platform,array $topics): void;
    public function getAll(): Collection;
}
