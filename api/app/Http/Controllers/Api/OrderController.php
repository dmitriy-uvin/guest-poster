<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\ByIdRequest;
use App\Action\Order\ChangeStatusAction;
use App\Action\Order\ChangeStatusRequest;
use App\Action\Order\CreateOrderAction;
use App\Action\Order\CreateOrderRequest;
use App\Action\Order\GetAllOrdersAction;
use App\Action\Order\GetOrderByIdAction;
use App\Action\Order\GetOrderByIdRequest;
use App\Action\Order\GetOrderCollectionByAuthUserAction;
use App\Action\Order\GetOrdersByUserIdAction;
use App\Http\Presenters\Order\OrderPresenter;
use App\Http\Requests\Order\ChangeOrderStatusHttpRequest;
use App\Http\Requests\Order\CreateOrderHttpRequest;
use App\Http\Requests\Order\GetOrderByIdHttpRequest;
use App\Repositories\Order\OrderRepository;
use Illuminate\Http\JsonResponse;

final class OrderController extends ApiController
{
    private OrderPresenter $orderPresenter;
    private CreateOrderAction $createOrderAction;
    private GetOrderCollectionByAuthUserAction $getOrderCollectionByAuthUserAction;
    private GetOrderByIdAction $getOrderByIdAction;
    private GetAllOrdersAction $getAllOrdersAction;
    private ChangeStatusAction $changeStatusAction;
    private GetOrdersByUserIdAction $getOrdersByUserIdAction;

    public function __construct(
        OrderPresenter $orderPresenter,
        CreateOrderAction $createOrderAction,
        GetOrderCollectionByAuthUserAction $getOrderCollectionByAuthUserAction,
        GetOrderByIdAction $getOrderByIdAction,
        GetAllOrdersAction $getAllOrdersAction,
        ChangeStatusAction $changeStatusAction,
        GetOrdersByUserIdAction $getOrdersByUserIdAction
    ) {
        $this->orderPresenter = $orderPresenter;
        $this->createOrderAction = $createOrderAction;
        $this->getOrderCollectionByAuthUserAction = $getOrderCollectionByAuthUserAction;
        $this->getOrderByIdAction = $getOrderByIdAction;
        $this->getAllOrdersAction = $getAllOrdersAction;
        $this->changeStatusAction = $changeStatusAction;
        $this->getOrdersByUserIdAction = $getOrdersByUserIdAction;
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

    public function getOrdersForAuthorizedUser(): JsonResponse
    {
        $response = $this->getOrderCollectionByAuthUserAction->execute();

        return $this->successResponse(
            $this->orderPresenter->presentCollection(
                $response->getOrders()
            )
        );
    }

    public function getOrderById(string $id, GetOrderByIdHttpRequest $request): JsonResponse
    {
        $response = $this->getOrderByIdAction->execute(
            new GetOrderByIdRequest((int)$id)
        );

        $sorting = $request->sorting ?: OrderRepository::DEFAULT_SORTING;
        $direction = $request->direction ?: OrderRepository::DEFAULT_DIRECTION;

        return $this->successResponse(
            $this->orderPresenter->presentSortedOrderItems(
                $response->getOrder(),
                $sorting,
                $direction,
            )
        );
    }

    public function getAllOrders(): JsonResponse
    {
        $response = $this->getAllOrdersAction->execute();

        return $this->successResponse($this->orderPresenter->presentCollection($response->getOrders()));
    }

    public function changeStatus(
        string $id,
        ChangeOrderStatusHttpRequest $request
    ): JsonResponse {
        $this->changeStatusAction->execute(
            new ChangeStatusRequest(
                (int)$id,
                $request->status
            )
        );

        return $this->emptyResponse();
    }

    public function getOrdersByUserId(string $id): JsonResponse
    {
        $response = $this->getOrdersByUserIdAction->execute(
            new ByIdRequest((int)$id)
        );

        return $this->successResponse(
            $this->orderPresenter->presentCollection($response->getOrders())
        );
    }
}
