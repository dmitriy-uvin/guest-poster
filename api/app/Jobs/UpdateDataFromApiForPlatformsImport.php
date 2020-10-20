<?php

namespace App\Jobs;

use App\Events\PlatformImportCreatedEvent;
use App\Events\PlatformImportUpdatedEvent;
use App\Exceptions\Import\ImportAPIErrorStatuses;
use App\Exceptions\Import\ImportErrorPropertyStatuses;
use App\Models\Alexa;
use App\Models\Facebook;
use App\Models\Majestic;
use App\Models\Moz;
use App\Models\Platform;
use App\Models\SemRush;
use App\Services\CheckTrustService;
use App\Services\SeoRankService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class UpdateDataFromApiForPlatformsImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $platformsCollection;
    private SeoRankService $seoRankService;
    private CheckTrustService $checkTrustService;

    public function __construct(array $platformsCollection)
    {
        $this->platformsCollection = $platformsCollection;
        $this->seoRankService = new SeoRankService();
        $this->checkTrustService = new CheckTrustService();
    }

    public function handle()
    {
        foreach ($this->platformsCollection as $platformData) {
            $url = $platformData['protocol'] . $platformData['website_url'];
            $platform = Platform::where('website_url', '=', $platformData['website_url'])->get()->first();
            if (is_null($platform)) {
                continue;
            }
            $mozSrAlexaFbData = $this->seoRankService->getDataForMozAlexaSemRushFb(
                $url
            );
            if (!in_array($mozSrAlexaFbData, ImportAPIErrorStatuses::getStatuses())) {
                $platform->organic_traffic =
                    in_array($mozSrAlexaFbData->sr_traffic, ImportErrorPropertyStatuses::getStatuses()) ?
                        null : $mozSrAlexaFbData->sr_traffic;
                $platform->save();

                Moz::where(['platform_id' => $platform->id])->update([
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

                SemRush::where(['platform_id' => $platform->id])->update([
                    'rank' =>
                        in_array($mozSrAlexaFbData->sr_rank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_rank,
                    'keyword_num' =>
                        in_array($mozSrAlexaFbData->sr_kwords, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_kwords,
                    'traffic_costs' =>
                        in_array($mozSrAlexaFbData->sr_costs, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_costs,
                ]);

                Alexa::where(['platform_id' => $platform->id])->update([
                    'rank' =>
                        in_array($mozSrAlexaFbData->a_rank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_rank,
                    'country' =>
                        in_array($mozSrAlexaFbData->a_cnt, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_cnt,
                    'country_rank' =>
                        in_array($mozSrAlexaFbData->a_cnt_r, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_cnt_r,
                ]);

                Facebook::where(['platform_id' => $platform->id])->update([
                    'fb_comments' =>
                        in_array($mozSrAlexaFbData->fb_comments, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_comments,
                    'fb_reac' =>
                        in_array($mozSrAlexaFbData->fb_reac, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_reac,
                    'fb_shares' =>
                        in_array($mozSrAlexaFbData->fb_shares, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_shares,
                ]);
            }

            $majesticData = $this->seoRankService->getDataForMajestic(
                $platform->website_url
            );
            if (!in_array($majesticData, ImportAPIErrorStatuses::getStatuses()) && is_object($majesticData))  {
                $majestic = Majestic::where(['platform_id' => $platform->id])->update([
                    'external_backlinks' =>
                        in_array($majesticData->ExtBackLinks, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->ExtBackLinks,
                    'external_gov' =>
                        in_array($majesticData->ExtBackLinksGOV, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->ExtBackLinksGOV,
                    'external_edu' =>
                        in_array($majesticData->ExtBackLinksEDU, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->ExtBackLinksEDU,
                    'tf' =>
                        in_array($majesticData->TrustFlow, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->TrustFlow,
                    'cf' =>
                        in_array($majesticData->CitationFlow, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->CitationFlow,
                    'refd' =>
                        in_array($majesticData->RefDomains, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->RefDomains,
                    'refd_edu' =>
                        in_array($majesticData->RefDomainsEDU, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->RefDomainsEDU,
                    'refd_gov' =>
                        in_array($majesticData->RefDomainsGOV, ImportErrorPropertyStatuses::getStatuses()) ? null : $majesticData->RefDomainsGOV,
                ]);
                $majestic->save();
            }

            $checkTrustData = $this->checkTrustService->getDataFromApiByPlatform(
                $url
            );

            if (is_object($checkTrustData)) {
                if ($checkTrustData->success) {
                    $platform->spam = $checkTrustData->summary->spam;
                    $platform->trust = $checkTrustData->summary->trust;
                    $platform->lrt_power_trust = $checkTrustData->summary->lrtPowerTrust;
                    $platform->save();
                } else {
                    broadcast(new PlatformImportCreatedEvent(
                        'error',
                        "CheckTrust Data not set! '<b>{$checkTrustData->message}</b>'"
                    ));
                }
            } else {
                broadcast(new PlatformImportCreatedEvent(
                    'error',
                    "CheckTrust Data not set! Something went wrong!"
                ));
            }
        }

        broadcast(new PlatformImportUpdatedEvent(
            'success',
            "Updating platforms from import finished!"
        ));
    }
}
