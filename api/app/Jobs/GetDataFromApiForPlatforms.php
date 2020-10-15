<?php

namespace App\Jobs;

use App\Exceptions\Import\ImportAPIErrorStatuses;
use App\Exceptions\Import\ImportErrorPropertyStatuses;
use App\Models\Alexa;
use App\Models\Facebook;
use App\Models\Majestic;
use App\Models\Moz;
use App\Models\SemRush;
use App\Models\User;
use App\Services\SeoRankService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class GetDataFromApiForPlatforms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Collection $platformsCollection;
    private SeoRankService $seoRankService;

    public function __construct(Collection $platformsCollection)
    {
        $this->platformsCollection = $platformsCollection;
        $this->seoRankService = new SeoRankService();
    }

    public function handle()
    {
        foreach ($this->platformsCollection as $platform) {
            $mozSrAlexaFbData = $this->seoRankService->getDataForMozAlexaSemRushFb(
                $platform->website_url
            );
            if (in_array($mozSrAlexaFbData, ImportAPIErrorStatuses::getStatuses())) {
                $moz = new Moz(['platform_id' => $platform->id]);
                $moz->save();

                $alexa = new Alexa(['platform_id' => $platform->id]);
                $alexa->save();

                $semrush = new SemRush(['platform_id' => $platform->id]);
                $semrush->save();

                $fb = new Facebook(['platform_id' => $platform->id]);
                $fb->save();
            } else {
                $platform->organic_traffic = $mozSrAlexaFbData->sr_traffic;
                $platform->save();

                $moz = new Moz([
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
                $moz->save();

                $semrush = new SemRush([
                    'platform_id' =>
                        $platform->id,
                    'rank' =>
                        in_array($mozSrAlexaFbData->sr_rank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_rank,
                    'keyword_num' =>
                        in_array($mozSrAlexaFbData->sr_kwords, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_kwords,
                    'traffic_costs' =>
                        in_array($mozSrAlexaFbData->sr_costs, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_costs,
                ]);
                $semrush->save();

                $alexa = new Alexa([
                    'platform_id' => $platform->id,
                    'rank' =>
                        in_array($mozSrAlexaFbData->a_rank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_rank,
                    'country' =>
                        in_array($mozSrAlexaFbData->a_cnt, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_cnt,
                    'country_rank' =>
                        in_array($mozSrAlexaFbData->a_cnt_r, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_cnt_r,
                ]);
                $alexa->save();

                $fb = new Facebook([
                    'platform_id' => $platform->id,
                    'fb_comments' =>
                        in_array($mozSrAlexaFbData->fb_comments, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_comments,
                    'fb_reac' =>
                        in_array($mozSrAlexaFbData->fb_reac, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_reac,
                    'fb_shares' =>
                        in_array($mozSrAlexaFbData->fb_shares, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_shares,
                ]);
                $fb->save();
            }

            $majestic = new Majestic(['platform_id' => $platform->id]);
            $majestic->save();
////            $majesticData = $this->seoRankService->getDataForMajestic(
////                $platform->website_url
////            );
////            if (in_array($majesticData, ImportAPIErrorStatuses::getStatuses())) {
////                $majestic = new Majestic(['platform_id' => $platform->id]);
////                $majestic->save();
////            } else {
////                $majestic = new Majestic([
////                    'platform_id' => $platform->id,
////                    'external_backlinks' =>
////                        in_array($majesticData->ExtBackLinks, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->ExtBackLinks,
////                    'external_gov' =>
////                        in_array($majesticData->ExtBackLinksGOV, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->ExtBackLinksGOV,
////                    'external_edu' =>
////                        in_array($majesticData->ExtBackLinksEDU, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->ExtBackLinksEDU,
////                    'tf' =>
////                        in_array($majesticData->TrustFlow, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->TrustFlow,
////                    'cf' =>
////                        in_array($majesticData->CitationFlow, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->CitationFlow,
////                    'refd' =>
////                        in_array($majesticData->RefDomains, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->RefDomains,
////                    'refd_edu' =>
////                        in_array($majesticData->RefDomainsEDU, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->RefDomainsEDU,
////                    'refd_gov' =>
////                        in_array($majesticData->RefDomainsGOV, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->RefDomainsGOV,
////                ]);
////                $majestic->save();
////            }
        }
    }
}
