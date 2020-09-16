<?php

declare(strict_types=1);

namespace App\Repositories\Platform;

use App\Models\Platform;

final class PlatformRepository implements PlatformRepositoryInterface
{
    public function getById(int $id): Platform
    {
        return Platform::find($id);
    }

    public function save(Platform $platform): Platform
    {
        $platform->save();

        return $platform;
    }

    public function delete(Platform $platform): void
    {
        $platform->delete();
    }

    public function saveTopics(Platform $platform,array $topics)
    {
        $platform
            ->topics()
            ->createMany($topics);
    }
}
