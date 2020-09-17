<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Models\Platform;
use App\Repositories\Platform\PlatformRepositoryInterface;

final class AddPlatformAction
{
    private PlatformRepositoryInterface $platformRepository;

    public function __construct(PlatformRepositoryInterface $platformRepository)
    {
        $this->platformRepository = $platformRepository;
    }

    public function execute(AddPlatformRequest $request)
    {
        $platform = new Platform();
        $platform->website_url = $request->getWebsiteUrl();
        $platform->dr = $request->getDr();
        $platform->ma = $request->getMa();
        $platform->organic_traffic = $request->getOrganicTraffic();
        $platform->do_follow_active = $request->getDoFollowActive();
        $platform->free_home_featured_active = $request->getFreeHomeFeaturedActive();
        $platform->niche_edit_link_active = $request->getNicheEditLinkActive();
        if ($request->getNicheEditLinkActive()) {
            $platform->niche_edit_link_price = $request->getNicheEditLinkPrice();
        }
        $platform->article_writing_price = $request->getArticleWritingPrice();
        $platform->contacts = $request->getContacts();
        $platform->price = $request->getPrice();
        $platform->email = $request->getEmail();
        $platform->comment = $request->getComment();

        $platform = $this->platformRepository->save($platform);

        return new AddPlatformResponse($platform);
    }
}
