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

        $filterQuery = Platform::query();

        if ($request->getDrFrom()) {
            $filterQuery = $filterQuery
                ->where('dr', '>=', $request->getDrFrom());
        }

        if ($request->getDrTo() > $request->getDrFrom()) {
            $filterQuery = $filterQuery
                ->where('dr', '<=', $request->getDrTo());
        }

        if ($request->getMaFrom()) {
            $filterQuery = $filterQuery
                ->where('ma', '>=', $request->getMaFrom());
        }

        if ($request->getMaFrom() < $request->getMaTo()) {
            $filterQuery = $filterQuery
                ->where('ma', '<=', $request->getMaTo());
        }

        if ($request->getOrganicTrafficFrom()) {
            $filterQuery = $filterQuery
                ->where('organic_traffic', '>=', $request->getOrganicTrafficFrom());
        }

        if ($request->getOrganicTrafficFrom() < $request->getOrganicTrafficTo()) {
            $filterQuery = $filterQuery
                ->where('organic_traffic', '<=', $request->getOrganicTrafficTo());
        }

        if ($request->getPriceFrom()) {
            $filterQuery = $filterQuery->where('price', '>=', $request->getPriceFrom());
        }

        if ($request->getPriceFrom() < $request->getPriceTo()) {
            $filterQuery = $filterQuery->where('price', '<=', $request->getPriceTo());
        }

        if ($request->getDofollow() === 'no') {
            $filterQuery = $filterQuery
                ->where('dofollow_active', '=', false);
        }

        if ($request->getDofollow() === 'yes') {
            $filterQuery = $filterQuery
                ->where('dofollow_active', '=', true);
        }

        if ($request->getNicheEditLink() === 'no') {
            $filterQuery = $filterQuery
                ->where('niche_edit_link_active', '=', false);
        }

        if ($request->getNicheEditLink() === 'yes') {
            $filterQuery = $filterQuery
                ->where('niche_edit_link_active', '=', true);
        }

        if ($request->getHomeFeatured() === 'no') {
            $filterQuery = $filterQuery
                ->where('free_home_featured_active', '=', false);
        }

        if ($request->getHomeFeatured() === 'yes') {
            $filterQuery = $filterQuery
                ->where('free_home_featured_active', '=', true);
        }

        if ($request->getMozDaFrom()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('da', '>=', $request->getMozDaFrom());
            });
        }

        if ($request->getMozDaFrom() < $request->getMozDaTo()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('da', '<=', $request->getMozDaTo());
            });
        }

        if ($request->getMozPaFrom()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('pa', '>=', $request->getMozPaFrom());
            });
        }

        if ($request->getMozPaFrom() < $request->getMozPaTo()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('pa', '<=', $request->getMozPaTo());
            });
        }

        if ($request->getMozRankFrom()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('rank', '>=', $request->getMozRankFrom());
            });
        }

        if ($request->getMozRankFrom() < $request->getMozRankTo()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('rank', '<=', $request->getMozRankTo());
            });
        }

        if ($request->getMozLinksInFrom()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('links_in', '>=', $request->getMozLinksInFrom());
            });
        }

        if ($request->getMozLinksInFrom() < $request->getMozLinksInTo()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('links_in', '<=', $request->getMozLinksInTo());
            });
        }

        if ($request->getAlexaRankFrom()) {
            $filterQuery = $filterQuery->whereHas('alexa', function($query) use ($request){
                $query->where('rank', '>=', $request->getAlexaRankFrom());
            });
        }

        if ($request->getAlexaRankFrom() < $request->getAlexaRankTo()) {
            $filterQuery = $filterQuery->whereHas('alexa', function($query) use ($request){
                $query->where('rank', '<=', $request->getAlexaRankTo());
            });
        }

        if ($request->getAlexaCountry()) {
            $filterQuery = $filterQuery->whereHas('alexa', function($query) use ($request){
                $query->where('country', '=', $request->getAlexaCountry());
            });
        }

        if ($request->getSemRushRankFrom()) {
            $filterQuery = $filterQuery->whereHas('semrush', function($query) use ($request){
                $query->where('rank', '>=', $request->getSemRushRankFrom());
            });
        }

        if ($request->getSemRushRankFrom() < $request->getSemRushRankTo()) {
            $filterQuery = $filterQuery->whereHas('semrush', function($query) use ($request){
                $query->where('rank', '<=', $request->getSemRushRankTo());
            });
        }

        if ($request->getSemRushKeywordNumFrom()) {
            $filterQuery = $filterQuery->whereHas('semrush', function($query) use ($request){
                $query->where('keyword_num', '>=', $request->getSemRushKeywordNumFrom());
            });
        }

        if ($request->getSemRushKeywordNumFrom() < $request->getSemRushKeywordNumTo()) {
            $filterQuery = $filterQuery->whereHas('semrush', function($query) use ($request){
                $query->where('keyword_num', '<=', $request->getSemRushKeywordNumTo());
            });
        }

        if ($request->getSemRushTrafficFrom()) {
            $filterQuery = $filterQuery->whereHas('semrush', function($query) use ($request){
                $query->where('traffic', '>=', $request->getSemRushTrafficFrom());
            });
        }

        if ($request->getSemRushTrafficFrom() < $request->getSemRushTrafficTo()) {
            $filterQuery = $filterQuery->whereHas('semrush', function($query) use ($request){
                $query->where('traffic', '<=', $request->getSemRushTrafficTo());
            });
        }

        if ($request->getSemRushTrafficCostsFrom()) {
            $filterQuery = $filterQuery->whereHas('semrush', function($query) use ($request){
                $query->where('traffic_costs', '>=', $request->getSemRushTrafficCostsFrom());
            });
        }

        if ($request->getSemRushTrafficCostsFrom() < $request->getSemRushTrafficCostsTo()) {
            $filterQuery = $filterQuery->whereHas('semrush', function($query) use ($request){
                $query->where('traffic_costs', '<=', $request->getSemRushTrafficCostsTo());
            });
        }

        if ($request->getMajesticExtBacklinksFrom()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('external_backlinks', '>=', $request->getMajesticExtBacklinksFrom());
            });
        }

        if ($request->getMajesticExtBacklinksFrom() < $request->getMajesticExtBacklinksTo()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('external_backlinks', '<=', $request->getMajesticExtBacklinksTo());
            });
        }

        if ($request->getMajesticExtGovFrom()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('external_gov', '>=', $request->getMajesticExtGovFrom());
            });
        }

        if ($request->getMajesticExtGovFrom() < $request->getMajesticExtGovTo()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('external_gov', '<=', $request->getMajesticExtGovTo());
            });
        }

        if ($request->getMajesticExtEduFrom()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('external_edu', '>=', $request->getMajesticExtEduFrom());
            });
        }

        if ($request->getMajesticExtEduFrom() < $request->getMajesticExtEduTo()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('external_edu', '<=', $request->getMajesticExtEduTo());
            });
        }

        if ($request->getMajesticCfFrom()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('cf', '>=', $request->getMajesticCfFrom());
            });
        }

        if ($request->getMajesticCfFrom() < $request->getMajesticCfTo()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('cf', '<=', $request->getMajesticCfTo());
            });
        }

        if ($request->getMajesticTfFrom()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('tf', '>=', $request->getMajesticTfFrom());
            });
        }

        if ($request->getMajesticTfFrom() < $request->getMajesticTfTo()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('tf', '<=', $request->getMajesticTfTo());
            });
        }

        if ($request->getTopics()) {
            $filterQuery = $filterQuery->whereHas('topics', function ($query) use ($request) {
                $query->whereIn('topic_id', $request->getTopics());
            });
        }

        $filterQuery = $filterQuery
            ->orderBy($sorting, $direction)
            ->paginate(
                $perPage, ['*'], null, $page
            );

        return new PaginatedResponse($filterQuery);
    }
}
