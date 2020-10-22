<?php

namespace App\Http\Controllers\Api;

use App\Action\DomainZone\GetDomainZoneCollectionAction;
use Illuminate\Http\JsonResponse;

final class DomainZoneController extends ApiController
{
    private GetDomainZoneCollectionAction $getDomainZonesCollectionAction;

    public function __construct(GetDomainZoneCollectionAction $getDomainZonesCollectionAction)
    {
        $this->getDomainZonesCollectionAction = $getDomainZonesCollectionAction;
    }

    public function getCollection(): JsonResponse
    {
        $response = $this->getDomainZonesCollectionAction->execute();

        return $this->successResponse($response->getDomainZones());
    }
}
