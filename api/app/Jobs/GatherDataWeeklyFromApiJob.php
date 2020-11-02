<?php

namespace App\Jobs;

use App\Exceptions\Import\ImportAPIErrorStatuses;
use App\Exceptions\Import\ImportErrorPropertyStatuses;
use App\Models\Data\AlexaData;
use App\Models\Data\FacebookData;
use App\Models\Data\MajesticData;
use App\Models\Data\MozData;
use App\Models\Data\SemRushData;
use App\Services\SeoRankService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class GatherDataWeeklyFromApiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Collection $platforms;
    private SeoRankService $seoRankService;

    public function __construct(Collection $platforms)
    {
        $this->platforms = $platforms;
        $this->seoRankService = new SeoRankService();
    }

    public function handle()
    {
        foreach ($this->platforms as $platform) {
            $url = '';
            if (mb_strpos('www', $platform->protocol) !== false) {
                $url = $platform->protocol . '.' . $platform->website_url;
            } else {
                $url = $platform->protocol . $platform->website_url;
            }
            $mozSrAlexaFbData = $this->seoRankService->getDataForMozAlexaSemRushFb(
                $url
            );
            if (!in_array($mozSrAlexaFbData, ImportAPIErrorStatuses::getStatuses())) {
                $mozData = new MozData([
                    'platform_id' => $platform->id,
                    'pa' =>
                        in_array($mozSrAlexaFbData->pa, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->pa,
                    'da' =>
                        in_array($mozSrAlexaFbData->pa, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->da,
                    'rank' =>
                        in_array($mozSrAlexaFbData->mozrank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->mozrank,
                    'links_in' =>
                        in_array($mozSrAlexaFbData->links, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->links,
                    'equity' =>
                        in_array($mozSrAlexaFbData->equity, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->equity,
                ]);
                $mozData->save();

                $semRushData = new SemRushData([
                    'platform_id' => $platform->id,
                    'rank' =>
                        in_array($mozSrAlexaFbData->sr_rank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_rank,
                    'keyword_num' =>
                        in_array($mozSrAlexaFbData->sr_kwords, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_kwords,
                    'traffic' => in_array($mozSrAlexaFbData->sr_traffic, ImportErrorPropertyStatuses::getStatuses()) ?
                        null : $mozSrAlexaFbData->sr_traffic,
                    'traffic_costs' =>
                        in_array($mozSrAlexaFbData->sr_costs, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_costs,
                ]);
                $semRushData->save();

                $alexaData = new AlexaData([
                    'platform_id' => $platform->id,
                    'rank' =>
                        in_array($mozSrAlexaFbData->a_rank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_rank,
                    'country' =>
                        in_array($mozSrAlexaFbData->a_cnt, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_cnt,
                    'country_rank' =>
                        in_array($mozSrAlexaFbData->a_cnt_r, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_cnt_r,
                ]);
                $alexaData->save();

                $facebookData = new FacebookData([
                    'platform_id' => $platform->id,
                    'comments' =>
                        in_array($mozSrAlexaFbData->fb_comments, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_comments,
                    'reactions' =>
                        in_array($mozSrAlexaFbData->fb_reac, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_reac,
                    'shares' =>
                        in_array($mozSrAlexaFbData->fb_shares, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_shares,
                ]);
                $facebookData->save();
            }

            $majesticDataApi = $this->seoRankService->getDataForMajestic(
                $platform->website_url
            );
            if (!in_array($majesticDataApi, ImportAPIErrorStatuses::getStatuses()) && is_object($majesticDataApi))  {
                $majesticData = new MajesticData([
                    'platform_id' => $platform->id,
                    'external_backlinks' =>
                        in_array($majesticDataApi->ExtBackLinks, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticDataApi->ExtBackLinks,
                    'external_gov' =>
                        in_array($majesticDataApi->ExtBackLinksGOV, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticDataApi->ExtBackLinksGOV,
                    'external_edu' =>
                        in_array($majesticDataApi->ExtBackLinksEDU, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticDataApi->ExtBackLinksEDU,
                    'tf' =>
                        in_array($majesticDataApi->TrustFlow, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticDataApi->TrustFlow,
                    'cf' =>
                        in_array($majesticDataApi->CitationFlow, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticDataApi->CitationFlow,
                    'refd' =>
                        in_array($majesticDataApi->RefDomains, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticDataApi->RefDomains,
                    'refd_edu' =>
                        in_array($majesticDataApi->RefDomainsEDU, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticDataApi->RefDomainsEDU,
                    'refd_gov' =>
                        in_array($majesticDataApi->RefDomainsGOV, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticDataApi->RefDomainsGOV,

                ]);
                $majesticData->save();
            }
        }
    }
}
