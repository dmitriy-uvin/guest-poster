<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\Platform\AddPlatformAction;
use App\Action\Platform\AddPlatformRequest;
use App\Action\Platform\GetPlatformCollectionAction;
use App\Action\Platform\GetPlatformCollectionRequest;
use App\Http\Presenters\Platform\PlatformPresenter;
use App\Http\Requests\PaginatedHttpRequest;
use App\Http\Requests\Platform\AddPlatformHttpRequest;
use Illuminate\Http\Request;

final class PlatformController extends ApiController
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
        $this->addPlatformAction->execute(
            new AddPlatformRequest(
                $request->website_url,
                (int)$request->dr,
                (int)$request->ma,
                (int)$request->organic_traffic,
                $request->dofollow_active,
                $request->free_home_featured_active,
                $request->niche_edit_link_active,
                (float)$request->article_writing_price,
                (float)$request->niche_edit_link_price,
                $request->contacts,
                (float)$request->price,
                $request->email,
                $request->comment,
                $request->topics,
                $request->moz,
                $request->alexa,
                $request->semrush,
                $request->majestic,
                $request->ahrefs,
                $request->description,
                $request->article_requirements,
                (int)$request->deadline,
                $request->where_posted
            )
        );

        return $this->emptyResponse();
    }

    public function getPlatformCollection(PaginatedHttpRequest $request)
    {
        $response = $this->getPlatformCollectionAction->execute(
            new GetPlatformCollectionRequest(
                (int)$request->query('page'),
                (int)$request->query('perPage'),
                $request->query('sorting'),
                $request->query('direction'),
                json_decode($request->query('filter'), true)
            )
        );

        return $this->createPaginatedResponse($response->getPaginator(), $this->platformPresenter);
    }
}
