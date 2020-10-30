<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Exceptions\Platform\PlatformAlreadyExistsException;
use App\Exceptions\Platform\PlatformNotFoundException;
use App\Models\Alexa;
use App\Models\Facebook;
use App\Models\Majestic;
use App\Models\Moz;
use App\Models\Platform;
use App\Models\SemRush;
use App\Repositories\Platform\PlatformRepositoryInterface;

final class UpdatePlatformByIdAction
{
    private PlatformRepositoryInterface $platformRepository;

    public function __construct(PlatformRepositoryInterface $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    public function execute(UpdatePlatformByIdRequest $request)
    {
        $platform = $this->platformRepository->getById($request->getPlatformId());

        if (is_null($platform)) {
            throw new PlatformNotFoundException();
        }

        if ($platform->website_url !== $request->getWebsiteUrl()) {
            if (Platform::where('website_url', '=', $request->getWebsiteUrl())->get()->first()) {
                throw new PlatformAlreadyExistsException();
            }
        }

        $platform->protocol = $request->getProtocol();
        $platform->website_url = $request->getWebsiteUrl();
        $platform->organic_traffic = $request->getOrganicTraffic();
        $platform->dofollow_active = $request->getDoFollowActive();
        $platform->free_home_featured_active = $request->getFreeHomeFeaturedActive();
        $platform->niche_edit_link_active = $request->getNicheEditLinkActive();
        if ($request->getNicheEditLinkActive()) {
            $platform->niche_edit_link_price = $request->getNicheEditLinkPrice();
        }
        $platform->article_writing_price = $request->getArticleWritingPrice();
        $platform->article_requirements = $request->getArticleRequirements();
        $platform->deadline = $request->getDeadLine();
        $platform->where_posted = $request->getWherePosted();
        $platform->contacts = $request->getContacts();
        $platform->comment = $request->getComment();
        $platform->price = $request->getPrice();
        $platform->description = $request->getDescription();
        $platform->email = $request->getEmail();
        $platform->domain_zone = $this->getDomainZone($request->getWebsiteUrl());
        $platform->trust = $request->getTrust();
        $platform->spam = $request->getSpam();
        $platform->lrt_power_trust = $request->getPowerTrust();
        $platform = $this->platformRepository->save($platform);

        Moz::where('platform_id', '=', $platform->id)
            ->update([
            'pa' => $request->getMozPA(),
            'da' => $request->getMozDA(),
            'rank' => $request->getMozRank(),
            'links_in' => $request->getMozLinksIn(),
            'equity' => $request->getMozEquity()
        ]);

        Alexa::where('platform_id', '=', $platform->id)->update([
            'rank' => $request->getAlexaRank(),
            'country' => $request->getAlexaCountry(),
            'country_rank' => $request->getAlexaCountryRank()
        ]);

        SemRush::where('platform_id', '=', $platform->id)->update([
            'rank' => $request->getSemrushRank(),
            'keyword_num' => $request->getSemrushKeywordNum(),
            'traffic_costs' => $request->getSemrushTrafficCosts(),
        ]);

        Facebook::where('platform_id', '=', $platform->id)->update([
            'fb_comments' => $request->getFbComments(),
            'fb_reac' => $request->getFbReactions(),
            'fb_shares' => $request->getFbShares()
        ]);

        Majestic::where('platform_id', '=', $platform->id)->update([
            'external_backlinks' => $request->getMajesticExternalBacklinks(),
            'external_gov' => $request->getMajesticExternalGov(),
            'external_edu' => $request->getMajesticExternalEdu(),
            'tf' => $request->getMajesticTF(),
            'cf' => $request->getMajesticCF(),
            'refd' => $request->getMajesticRefD(),
            'refd_edu' => $request->getMajesticRefDEDU(),
            'refd_gov' => $request->getMajesticRefDGOV(),
        ]);

        return new UpdatePlatformByIdResponse($platform);
    }

    private function getDomainZone(string $websiteUrl): string
    {
        $string = trim($websiteUrl, '/');
        $domain = explode('/', $string)[0];
        $domainParts = explode('.', $domain);

        if (isset($domainParts[count($domainParts) - 1])) {
            return $domainParts[count($domainParts) - 1];
        }
        return '';
    }
}
