<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\PaginatedResponse;
use App\Constants\PlatformTrustSummary;
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

        $filterQuery = $filterQuery->where('in_trash', '=', false);

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

        if ($request->getDeadline()) {
            $filterQuery = $filterQuery->where('deadline', '<=', $request->getDeadline());
        }

        if ($request->getDofollow() === 'no') {
            $filterQuery = $filterQuery
                ->where('dofollow_active', '=', false);
        } else if ($request->getDofollow() === 'yes') {
            $filterQuery = $filterQuery
                ->where('dofollow_active', '=', true);
        }

        if ($request->getNicheEditLink() === 'no') {
            $filterQuery = $filterQuery
                ->where('niche_edit_link_active', '=', false);
        } else if ($request->getNicheEditLink() === 'yes') {
            $filterQuery = $filterQuery
                ->where('niche_edit_link_active', '=', true);
        }

        if ($request->getHomeFeatured() === 'no') {
            $filterQuery = $filterQuery
                ->where('free_home_featured_active', '=', false);
        } else if ($request->getHomeFeatured() === 'yes') {
            $filterQuery = $filterQuery
                ->where('free_home_featured_active', '=', true);
        }

        if ($request->getMoneyAnchor() === 'no') {
            $filterQuery = $filterQuery
                ->where('money_anchor', '=', false);
        } else if ($request->getMoneyAnchor() === 'yes') {
            $filterQuery = $filterQuery
                ->where('money_anchor', '=', true);
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

        if ($request->getDomainZones()) {
            $filterQuery = $filterQuery->whereIn('domain_zone', $request->getDomainZones());
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

        if ($request->getMozEquityFrom()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('equity', '>=', $request->getMozEquityFrom());
            });
        }
        if ($request->getMozEquityFrom() < $request->getMozEquityTo()) {
            $filterQuery = $filterQuery->whereHas('moz', function($query) use ($request){
                $query->where('equity', '<=', $request->getMozEquityTo());
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

        if (count($request->getAlexaCountries())) {
            $filterQuery = $filterQuery->whereHas('alexa', function($query) use ($request){
                $query->whereIn('country', $request->getAlexaCountries());
            });
        }

        if ($request->getAlexaCountryRankFrom()) {
            $filterQuery = $filterQuery->whereHas('alexa', function($query) use ($request){
                $query->where('country_rank', '>=', $request->getAlexaCountryRankFrom());
            });
        }
        if ($request->getAlexaCountryRankFrom() < $request->getAlexaCountryRankTo()) {
            $filterQuery = $filterQuery->whereHas('alexa', function($query) use ($request){
                $query->where('country_rank', '<=', $request->getAlexaCountryRankTo());
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

        if ($request->getMajesticRefDFrom()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('refd', '<=', $request->getMajesticRefDFrom());
            });
        }
        if ($request->getMajesticRefDFrom() < $request->getMajesticRefDTo()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('refd', '<=', $request->getMajesticRefDTo());
            });
        }

        if ($request->getMajesticRefDEduFrom()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('refd_edu', '<=', $request->getMajesticRefDEduFrom());
            });
        }
        if ($request->getMajesticRefDEduFrom() < $request->getMajesticRefDEduTo()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('refd_edu', '<=', $request->getMajesticRefDEduTo());
            });
        }

        if ($request->getMajesticRefDGovFrom()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('refd_gov', '<=', $request->getMajesticRefDGovFrom());
            });
        }
        if ($request->getMajesticRefDGovFrom() < $request->getMajesticRefDGovTo()) {
            $filterQuery = $filterQuery->whereHas('majestic', function($query) use ($request){
                $query->where('refd_gov', '<=', $request->getMajesticRefDGovTo());
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

        if ($request->getFacebookCommentsFrom()) {
            $filterQuery = $filterQuery->whereHas('facebook', function($query) use ($request){
                $query->where('fb_comments', '>=', $request->getFacebookCommentsFrom());
            });
        }
        if ($request->getFacebookCommentsFrom() < $request->getFacebookCommentsTo()) {
            $filterQuery = $filterQuery->whereHas('facebook', function($query) use ($request){
                $query->where('fb_comments', '<=', $request->getFacebookCommentsTo());
            });
        }

        if ($request->getFacebookReactionsFrom()) {
            $filterQuery = $filterQuery->whereHas('facebook', function($query) use ($request){
                $query->where('fb_reac', '>=', $request->getFacebookReactionsFrom());
            });
        }
        if ($request->getFacebookReactionsFrom() < $request->getFacebookReactionsTo()) {
            $filterQuery = $filterQuery->whereHas('facebook', function($query) use ($request){
                $query->where('fb_reac', '<=', $request->getFacebookReactionsTo());
            });
        }

        if ($request->getFacebookSharesFrom()) {
            $filterQuery = $filterQuery->whereHas('facebook', function($query) use ($request){
                $query->where('fb_shares', '>=', $request->getFacebookSharesFrom());
            });
        }
        if ($request->getFacebookSharesFrom() < $request->getFacebookSharesTo()) {
            $filterQuery = $filterQuery->whereHas('facebook', function($query) use ($request){
                $query->where('fb_shares', '<=', $request->getFacebookSharesTo());
            });
        }

        if ($request->getAhrefsRankFrom()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('rank', '>=', $request->getAhrefsRankFrom());
            });
        }
        if ($request->getAhrefsRankFrom() < $request->getAhrefsRankTo()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('rank', '<=', $request->getAhrefsRankTo());
            });
        }

        if ($request->getAhrefsDrFrom()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('dr', '>=', $request->getAhrefsDrFrom());
            });
        }
        if ($request->getAhrefsDrFrom() < $request->getAhrefsDrTo()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('dr', '<=', $request->getAhrefsDrTo());
            });
        }

        if ($request->getAhrefsExtBacklinksFrom()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('eb', '>=', $request->getAhrefsExtBacklinksFrom());
            });
        }
        if ($request->getAhrefsExtBacklinksFrom() < $request->getAhrefsExtBacklinksTo()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('eb', '<=', $request->getAhrefsExtBacklinksTo());
            });
        }

        if ($request->getAhrefsRefDFrom()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('rd', '>=', $request->getAhrefsExtBacklinksFrom());
            });
        }
        if ($request->getAhrefsRefDFrom() < $request->getAhrefsRefDTo()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('rd', '<=', $request->getAhrefsRefDTo());
            });
        }

        if ($request->getAhrefsDofollowFrom()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('dofollow', '>=', $request->getAhrefsDofollowFrom());
            });
        }
        if ($request->getAhrefsDofollowFrom() < $request->getAhrefsDofollowTo()) {
            $filterQuery = $filterQuery->whereHas('ahrefs', function($query) use ($request){
                $query->where('dofollow', '<=', $request->getAhrefsDofollowTo());
            });
        }

        if ($request->getCheckTrustFrom()) {
            $filterQuery = $filterQuery
                ->where('trust', '>=', $request->getCheckTrustFrom());
        }
        if ($request->getCheckTrustFrom() < $request->getCheckTrustTo()) {
            $filterQuery = $filterQuery
                ->where('trust', '<=', $request->getCheckTrustTo());
        }

        if ($request->getSpamFrom()) {
            $filterQuery = $filterQuery
                ->where('spam', '>=', $request->getSpamFrom());
        }
        if ($request->getSpamFrom() < $request->getSpamTo()) {
            $filterQuery = $filterQuery
                ->where('spam', '<=', $request->getSpamTo());
        }

        if ($request->getPowerTrustFrom()) {
            $filterQuery = $filterQuery
                ->where('lrt_power_trust', '>=', $request->getPowerTrustFrom());
        }
        if ($request->getPowerTrustFrom() < $request->getPowerTrustTo()) {
            $filterQuery = $filterQuery
                ->where('lrt_power_trust', '<=', $request->getPowerTrustTo());
        }

        if ($sorting === 'moz.da') {
            $filterQuery = $filterQuery
                ->join('moz', 'moz.platform_id', '=', 'platforms.id')
                ->orderBy('moz.da', $direction)
                ->select('platforms.*');
        } else if ($sorting === 'website') {
            $filterQuery = $filterQuery->orderBy('website_url', $direction);
        } else if ($sorting === 'trust') {
            $filterQuery = $filterQuery->orderBy('trust', $direction);
        } else if ($sorting === 'semrush.traffic') {
            $filterQuery = $filterQuery->orderBy('organic_traffic', $direction);
        } else if ($sorting === 'ahrefs.dr') {
            $filterQuery = $filterQuery
                ->join('ahrefs', 'ahrefs.platform_id', '=', 'platforms.id')
                ->orderBy('ahrefs.dr', $direction)
                ->select('platforms.*');
        } else if ($sorting === 'semrush.traffic_costs') {
            $filterQuery = $filterQuery
                ->join('semrush', 'semrush.platform_id', '=', 'platforms.id')
                ->orderBy('semrush.traffic_costs', $direction)
                ->select('platforms.*');
        } else if ($sorting === 'majestic.tf') {
            $filterQuery = $filterQuery
                ->join('majestic', 'majestic.platform_id', '=', 'platforms.id')
                ->orderBy('majestic.tf', $direction)
                ->select('platforms.*');
        } else if ($sorting === 'majestic.cf') {
            $filterQuery = $filterQuery
                ->join('majestic', 'majestic.platform_id', '=', 'platforms.id')
                ->orderBy('majestic.cf', $direction)
                ->select('platforms.*');
        } else if ($sorting === 'alexa.rank') {
            $filterQuery = $filterQuery
                ->join('alexa', 'alexa.platform_id', '=', 'platforms.id')
                ->orderBy('alexa.rank', $direction)
                ->select('platforms.*');
        } else if ($sorting === 'majestic.ebl') {
            $filterQuery = $filterQuery
                ->join('majestic', 'majestic.platform_id', '=', 'platforms.id')
                ->orderBy('majestic.external_backlinks', $direction)
                ->select('platforms.*');
        } else if ($sorting === 'semrush.rank') {
            $filterQuery = $filterQuery
                ->join('semrush', 'semrush.platform_id', '=', 'platforms.id')
                ->orderBy('semrush.rank', $direction)
                ->select('platforms.*');
        } else if ($sorting === 'ahrefs.rd') {
            $filterQuery = $filterQuery
                ->join('ahrefs', 'ahrefs.platform_id', '=', 'platforms.id')
                ->orderBy('ahrefs.rd', $direction)
                ->select('platforms.*');
        } else {
            $filterQuery = $filterQuery
                ->orderBy($sorting, $direction);
        }

        $filterQuery = $filterQuery
            ->paginate(
                $perPage, ['*'], null, $page
            );

        return new PaginatedResponse($filterQuery);
    }
}
