<?php

declare(strict_types=1);

namespace App\Action\DomainZone;

use Illuminate\Support\Collection;

final class GetDomainZoneCollectionResponse
{
    private array $domainZones;

    public function __construct(array $domainZones)
    {
        $this->domainZones = $domainZones;
    }

    public function getDomainZones(): array
    {
        return $this->domainZones;
    }
}
