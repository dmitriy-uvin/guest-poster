<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Presenters\Contracts\PresenterCollectionInterface;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    use ValidatesRequests;

    protected function successResponse(array $data, int $status = JsonResponse::HTTP_OK): JsonResponse
    {
        return new JsonResponse(['data' => $data], $status);
    }

    protected function emptyResponse(int $status = JsonResponse::HTTP_NO_CONTENT): JsonResponse
    {
        return new JsonResponse(null, $status);
    }

    protected function errorResponse(string $message, int $status = JsonResponse::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse([
            'error' => [
                'http_code' => $status,
                'message' => $message
            ]
        ], $status);
    }

    protected function createPaginatedResponse(
        LengthAwarePaginator $paginator,
        PresenterCollectionInterface $presenter
    ): JsonResponse {
        return new JsonResponse([
            'data' => $presenter->presentCollection(collect($paginator->items())),
            'meta' => [
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage()
            ]
        ]);
    }
}
