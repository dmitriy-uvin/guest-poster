<?php

namespace App\Http\Controllers\Api;

use App\Action\Platform\AddPlatformAction;
use App\Action\Platform\AddPlatformRequest;
use App\Action\Platform\GetPlatformCollectionAction;
use App\Action\Platform\GetPlatformCollectionRequest;
use App\Http\Presenters\Platform\PlatformPresenter;
use App\Http\Requests\PaginatedHttpRequest;
use App\Http\Requests\Platform\AddPlatformHttpRequest;
use Illuminate\Http\Request;

class PlatformController extends ApiController
{
    private PlatformPresenter $platformPresenter;
    private AddPlatformAction $addPlatformAction;
    private GetPlatformCollectionAction $getPlatformCollectionAction;

    public function __construct(
        AddPlatformAction $addPlatformAction,
        PlatformPresenter $platformPresenter,
        GetPlatformCollectionAction $getPlatformCollectionAction
    ) {
        $this->platformPresenter = $platformPresenter;
        $this->addPlatformAction = $addPlatformAction;
        $this->getPlatformCollectionAction = $getPlatformCollectionAction;
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

    public function getPlatformCollection(PaginatedHttpRequest $request)
    {
        $response = $this->getPlatformCollectionAction->execute(
            new GetPlatformCollectionRequest(
                (int)$request->query('page'),
                (int)$request->query('perPage'),
                $request->query('sorting'),
                $request->query('direction'),
            )
        );

        return $this->createPaginatedResponse($response->getPaginator(), $this->platformPresenter);
    }
}