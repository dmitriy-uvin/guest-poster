<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\Topic\GetTopicCollectionAction;
use Illuminate\Http\JsonResponse;

final class TopicController extends ApiController
{
    private GetTopicCollectionAction $getTopicCollectionAction;

    public function __construct(GetTopicCollectionAction $getTopicCollectionAction)
    {
        $this->getTopicCollectionAction = $getTopicCollectionAction;
    }

    public function getTopicCollection(): JsonResponse
    {
        $topics = $this->getTopicCollectionAction->execute()->getTopics();

        return $this->successResponse($topics->toArray());
    }
}
