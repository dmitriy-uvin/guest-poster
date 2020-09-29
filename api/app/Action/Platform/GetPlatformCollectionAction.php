<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\PaginatedResponse;
use App\Models\Platform;
use App\Repositories\Platform\PlatformRepository;
use App\Repositories\Platform\PlatformRepositoryInterface;

final class GetPlatformCollectionAction
{
    private PlatformRepositoryInterface $platformRepository;

    public function __construct(PlatformRepositoryInterface $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    public function execute(GetPlatformCollectionRequest $request)
    {
        $page = $request->getPage() ?: PlatformRepository::DEFAULT_PAGE;
        $perPage = $request->getPerPage() ?: PlatformRepository::DEFAULT_PER_PAGE;
        $sorting = $request->getSorting() ?: PlatformRepository::DEFAULT_SORTING;
        $direction = $request->getDirection() ?: PlatformRepository::DEFAULT_DIRECTION;

        $query = Platform::query();

        if ($request->getMozDaFrom() && $request->getMozDaTo()) {
            $query = Platform::whereHas('moz', function($query) use ($request){
                $query
                    ->where('da', '>=', $request->getMozDaFrom())
                    ->where('da', '<=', $request->getMozDaTo());
            });
        }

        if ($request->getMozPaFrom() && $request->getMozPaTo()) {
            $query = Platform::whereHas('moz', function($query) use ($request){
                $query
                    ->where('pa', '>=', $request->getMozPaFrom())
                    ->where('pa', '<=', $request->getMozPaTo());
            });
        }

        if ($request->getMozRankFrom() && $request->getMozRankTo()) {
            $query = Platform::whereHas('moz', function($query) use ($request){
                $query
                    ->where('rank', '>=', $request->getMozRankFrom())
                    ->where('rank', '<=', $request->getMozRankTo());
            });
        }

        if ($request->getMozLinksInFrom() && $request->getMozLinksInTo()) {
            $query = Platform::whereHas('moz', function($query) use ($request){
                $query
                    ->where('links_in', '>=', $request->getMozLinksInFrom())
                    ->where('links_in', '<=', $request->getMozLinksInTo());
            });
        }

        if ($request->getAlexaRankFrom() && $request->getAlexaRankTo()) {
            $query = Platform::whereHas('alexa', function($query) use ($request){
                $query
                    ->where('rank', '>=', $request->getAlexaRankFrom())
                    ->where('rank', '<=', $request->getAlexaRankTo());
            });
        }

        if ($request->getAlexaCountry()) {
            $query = Platform::whereHas('alexa', function($query) use ($request){
                $query->where('country', '=', $request->getAlexaCountry());
            });
        }

        if ($request->getSemRushRankFrom() && $request->getSemRushRankTo()) {
            $query = Platform::whereHas('semrush', function($query) use ($request){
                $query
                    ->where('rank', '>=', $request->getSemRushRankFrom())
                    ->where('rank', '<=', $request->getSemRushRankTo());
            });
        }

        if ($request->getSemRushKeywordNumFrom() && $request->getSemRushKeywordNumTo()) {
            $query = Platform::whereHas('semrush', function($query) use ($request){
                $query
                    ->where('keyword_num', '>=', $request->getSemRushKeywordNumFrom())
                    ->where('keyword_num', '<=', $request->getSemRushKeywordNumTo());
            });
        }

        if ($request->getSemRushTrafficFrom() && $request->getSemRushTrafficTo()) {
            $query = Platform::whereHas('semrush', function($query) use ($request){
                $query
                    ->where('traffic', '>=', $request->getSemRushTrafficFrom())
                    ->where('traffic', '<=', $request->getSemRushTrafficTo());
            });
        }

        if ($request->getSemRushTrafficCostsFrom() && $request->getSemRushTrafficCostsTo()) {
            $query = Platform::whereHas('semrush', function($query) use ($request){
                $query
                    ->where('traffic_costs', '>=', $request->getSemRushTrafficCostsFrom())
                    ->where('traffic_costs', '<=', $request->getSemRushTrafficCostsTo());
            });
        }

        if ($request->getMajesticExtBacklinksFrom() && $request->getMajesticExtBacklinksTo()) {
            $query = Platform::whereHas('majestic', function($query) use ($request){
                $query
                    ->where('external_backlinks', '>=', $request->getMajesticExtBacklinksFrom())
                    ->where('external_backlinks', '<=', $request->getMajesticExtBacklinksTo());
            });
        }

        if ($request->getMajesticExtGovFrom() && $request->getMajesticExtGovTo()) {
            $query = Platform::whereHas('majestic', function($query) use ($request){
                $query
                    ->where('external_gov', '>=', $request->getMajesticExtGovFrom())
                    ->where('external_gov', '<=', $request->getMajesticExtGovTo());
            });
        }

        if ($request->getMajesticExtEduFrom() && $request->getMajesticExtEduTo()) {
            $query = Platform::whereHas('majestic', function($query) use ($request){
                $query
                    ->where('external_edu', '>=', $request->getMajesticExtEduFrom())
                    ->where('external_edu', '<=', $request->getMajesticExtEduTo());
            });
        }

        if ($request->getMajesticCfFrom() && $request->getMajesticCfTo()) {
            $query = Platform::whereHas('majestic', function($query) use ($request){
                $query
                    ->where('cf', '>=', $request->getMajesticCfFrom())
                    ->where('cf', '<=', $request->getMajesticCfTo());
            });
        }

        if ($request->getMajesticTfFrom() && $request->getMajesticTfTo()) {
            $query = Platform::whereHas('majestic', function($query) use ($request){
                $query
                    ->where('tf', '>=', $request->getMajesticTfFrom())
                    ->where('tf', '<=', $request->getMajesticTfTo());
            });
        }

        $query = $query
            ->orderBy($sorting, $direction)
            ->paginate(
                $perPage, ['*'], null, $page
            );

        return new PaginatedResponse($query);
    }
}
