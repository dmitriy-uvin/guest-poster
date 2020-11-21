<?php

namespace App\Jobs;

use App\Events\PlatformImportCreatedEvent;
use App\Exceptions\Import\ImportAPIErrorStatuses;
use App\Exceptions\Import\ImportErrorPropertyStatuses;
use App\Models\Ahrefs;
use App\Models\Alexa;
use App\Models\Facebook;
use App\Models\Majestic;
use App\Models\Moz;
use App\Models\Platform;

use App\Models\SemRush;
use App\Models\Topic;
use App\Services\CheckTrustService;
use App\Services\SeoRankService;
use App\Services\SummaryStatusService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportPlatformsAndGetApiDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $platformsCollection;
    private SeoRankService $seoRankService;
    private CheckTrustService $checkTrustService;
    private int $row;

    public function __construct(array $platformsCollection, int $row = 1)
    {
        $this->platformsCollection = $platformsCollection;
        $this->seoRankService = new SeoRankService();
        $this->checkTrustService = new CheckTrustService();
        $this->row = $row;
    }

    private function getPlatformObj(array $platformData): Platform {
        $platformObj = new Platform();
        $platformObj->protocol = $platformData['protocol'];
        $platformObj->website_url = $platformData['website_url'];
        $platformObj->organic_traffic = $platformData['organic_traffic'];
        $platformObj->dofollow_active = $platformData['dofollow_active'];
        $platformObj->free_home_featured_active = $platformData['free_home_featured_active'];
        $platformObj->niche_edit_link_active = $platformData['niche_edit_link_active'];
        $platformObj->money_anchor = $platformData['money_anchor'];
        $platformObj->niche_edit_link_price = $platformData['niche_edit_link_price'];
        $platformObj->article_writing_price = $platformData['article_writing_price'];
        $platformObj->article_requirements = $platformData['article_requirements'];
        $platformObj->deadline = $platformData['deadline'];
        $platformObj->domain_zone = $platformData['domain_zone'];
        $platformObj->price = $platformData['price'];
        $platformObj->email = $platformData['email'];
        $platformObj->description = $platformData['description'];
        $platformObj->where_posted = $platformData['where_posted'];
        $platformObj->contacts = $platformData['contacts'];
        $platformObj->comment = $platformData['comment'];
        return $platformObj;
    }

    public function handle()
    {
        foreach ($this->platformsCollection as $platformData) {
            $platform = Platform::where('website_url', '=', $platformData['website_url'])
                ->get()
                ->first();

            if (!$platform) {
                $url = '';
                $platformObj = '';
                if (mb_strpos('www', $platformData['protocol']) !== false) {
                    $url = trim($platformData['protocol'], '.') . '.' . $platformData['website_url'];
                } else {
                    $url = $platformData['protocol'] . $platformData['website_url'];
                }
                $mozSrAlexaFbData = $this->seoRankService->getDataForMozAlexaSemRushFb(
                    $url
                );
                if (in_array($mozSrAlexaFbData, ImportAPIErrorStatuses::getStatuses()) || !is_object($mozSrAlexaFbData)) {
                    $message = "Failed to add platform " . $platformData['website_url'] .
                        " at line: " . $this->row . " ($mozSrAlexaFbData)";

                    broadcast(new PlatformImportCreatedEvent(
                        'error',
                        $message
                    ));
                }
                else {
                    $platformTopics = explode(',', $platformData['topics']);
                    $platformTopics = array_map(fn($topic) => trim($topic), $platformTopics);
                    $topicsIds = Topic::whereIn('name', $platformTopics)
                        ->get('id')
                        ->map(fn($topic) => $topic->id)
                        ->all();
                    $platformObj = $this->getPlatformObj($platformData);
                    $platformObj->save();
                    $platformObj->topics()->attach($topicsIds);

                    $platformObj->organic_traffic =
                        in_array($mozSrAlexaFbData->sr_traffic, ImportErrorPropertyStatuses::getStatuses()) ?
                            null : $mozSrAlexaFbData->sr_traffic;
                    $platformObj->save();
                    $moz = new Moz([
                        'pa' =>
                            in_array($mozSrAlexaFbData->pa, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->pa,
                        'da' =>
                            in_array($mozSrAlexaFbData->da, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->da,
                        'rank' =>
                            in_array($mozSrAlexaFbData->mozrank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->mozrank,
                        'links_in' =>
                            in_array($mozSrAlexaFbData->links, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->links,
                        'equity' =>
                            in_array($mozSrAlexaFbData->equity, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->equity,
                    ]);
                    $platformObj->moz()->save($moz);

                    $semrush = new SemRush([
                        'rank' =>
                            in_array($mozSrAlexaFbData->sr_rank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_rank,
                        'keyword_num' =>
                            in_array($mozSrAlexaFbData->sr_kwords, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_kwords,
                        'traffic_costs' =>
                            in_array($mozSrAlexaFbData->sr_costs, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->sr_costs,
                    ]);
                    $platformObj->semrush()->save($semrush);

                    $alexa = new Alexa([
                        'rank' =>
                            in_array($mozSrAlexaFbData->a_rank, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_rank,
                        'country' =>
                            in_array($mozSrAlexaFbData->a_cnt, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_cnt,
                        'country_rank' =>
                            in_array($mozSrAlexaFbData->a_cnt_r, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->a_cnt_r,
                    ]);
                    $platformObj->alexa()->save($alexa);

                    $fb = new Facebook([
                        'fb_comments' =>
                            in_array($mozSrAlexaFbData->fb_comments, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_comments,
                        'fb_reac' =>
                            in_array($mozSrAlexaFbData->fb_reac, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_reac,
                        'fb_shares' =>
                            in_array($mozSrAlexaFbData->fb_shares, ImportErrorPropertyStatuses::getStatuses()) ? null : $mozSrAlexaFbData->fb_shares,
                    ]);
                    $platformObj->facebook()->save($fb);

                    $ahrefs = new Ahrefs();
                    $platformObj->ahrefs()->save($ahrefs);
                }


                $majesticData = $this->seoRankService->getDataForMajestic(
                    $url
                );
                if (in_array($majesticData, ImportAPIErrorStatuses::getStatuses()) || !is_object($majesticData)) {
                    $majestic = new Majestic();
                    $platformObj->majestic()->save($majestic);
                    $message = "Failed to fetch Majestic Data! {$majesticData} Line: {$this->row}.";

                    broadcast(new PlatformImportCreatedEvent(
                        'error',
                        $message
                    ));
                }
                else {
                    $majestic = new Majestic([
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
                    $platformObj->majestic()->save($majestic);
                }

                $checkTrustData = $this->checkTrustService->getDataFromApiByPlatform(
                    $url
                );

                if (is_object($checkTrustData)) {
                    if ($checkTrustData->success) {
                        $platformObj->spam ??= $checkTrustData->summary->spam;
                        $platformObj->trust ??= $checkTrustData->summary->trust;
                        $platformObj->lrt_power_trust ??= $checkTrustData->summary->lrtPowerTrust;
                        $summaryStatus = SummaryStatusService::getSummaryStatus(
                            (int)$platformObj->trust,
                            (int)$platformObj->spam,
                            (int)$platformObj->lrt_power_trust
                        );
                        $platformObj->summary_status = $summaryStatus;
                        $platformObj->save();
                    } else {
                        broadcast(new PlatformImportCreatedEvent(
                            'error',
                            "CheckTrust Data not set! '<b>{$checkTrustData->message}</b>'.
                        Line {$this->row}. Platform: <b>{$platform->website_url}</b>"
                        ));
                    }
                } else {
                    broadcast(new PlatformImportCreatedEvent(
                        'error',
                        "CheckTrust Data not set! Something went wrong! Line {$this->row}"
                    ));
                }

                broadcast(new PlatformImportCreatedEvent(
                    'success',
                    "Platform <b>{$url}</b> was added!"
                ));
            }
            $this->row += 1 ;
        }
    }
}
