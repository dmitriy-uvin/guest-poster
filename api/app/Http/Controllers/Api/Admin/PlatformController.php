<?php

namespace App\Http\Controllers\Api\Admin;

use App\Action\Platform\AddPlatformAction;
use App\Action\Platform\AddPlatformRequest;
use App\Http\Controllers\Api\ApiController;
use App\Http\Presenters\Platform\PlatformPresenter;
use App\Http\Requests\Platform\AddPlatformHttpRequest;
use Illuminate\Http\Request;

class PlatformController extends ApiController
{
    private PlatformPresenter $platformPresenter;
    private AddPlatformAction $addPlatformAction;

    public function __construct(
        AddPlatformAction $addPlatformAction,
        PlatformPresenter $platformPresenter
    ) {
        $this->platformPresenter = $platformPresenter;
        $this->addPlatformAction = $addPlatformAction;
    }

    public function savePlatform(AddPlatformHttpRequest $request)
    {
        $response = $this->addPlatformAction->execute(
            new AddPlatformRequest(
                $request->website_url,
                $request->dr,
                $request->ma,
                $request->organic_traffic,
                $request->do_follow_active,
                $request->free_home_featured_active,
                $request->niche_edit_link_active,
                $request->article_writing_price,
                $request->niche_edit_link_price,
                $request->contacts,
                $request->price,
                $request->email,
                $request->comment,
            )
        );

        return $this->successResponse($this->platformPresenter->present($response->getPlatform()));
    }
}
