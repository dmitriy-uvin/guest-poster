<?php

declare(strict_types=1);

namespace App\Action\DomainZone;

use App\Models\Platform;

final class GetDomainZoneCollectionAction
{
    public function execute()
    {
        $domainZones = Platform::all()
            ->map(fn($platform) => $platform->domain_zone)
            ->unique()
            ->values()
            ->all();
        return new GetDomainZoneCollectionResponse($domainZones);
    }
}
