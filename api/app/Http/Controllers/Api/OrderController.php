<?php

namespace App\Http\Controllers\Api;

use App\Action\Order\CreateOrderAction;
use App\Action\Order\CreateOrderRequest;
use App\Action\Order\GetOrderCollectionByAuthUserAction;
use App\Http\Presenters\Order\OrderPresenter;
use App\Http\Requests\Order\CreateOrderHttpRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends ApiController
{
    private OrderPresenter $orderPresenter;
    private CreateOrderAction $createOrderAction;
    private GetOrderCollectionByAuthUserAction $getOrderCollectionByAuthUserAction;

    public function __construct(
        OrderPresenter $orderPresenter,
        CreateOrderAction $createOrderAction,
        GetOrderCollectionByAuthUserAction $getOrderCollectionByAuthUserAction
    ) {
        $this->orderPresenter = $orderPresenter;
        $this->createOrderAction = $createOrderAction;
        $this->getOrderCollectionByAuthUserAction = $getOrderCollectionByAuthUserAction;
    }

    public function createOrder(CreateOrderHttpRequest $request): JsonResponse
    {
        $this->createOrderAction->execute(
            new CreateOrderRequest(
                $request->type,
                $request->platform_ids,
                $request->comment
            )
        );

        return $this->emptyResponse();
    }

    public function getOrdersForAuthorizedUser()
    {
        $response = $this->getOrderCollectionByAuthUserAction->execute();

        return $this->successResponse($this->orderPresenter->presentCollection(
            $response->getOrders()
        ));
    }
}
