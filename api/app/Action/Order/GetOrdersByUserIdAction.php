<?php

declare(strict_types=1);

namespace App\Action\Order;

use App\Action\ByIdRequest;
use App\Exceptions\User\UserNotFoundException;
use App\Repositories\User\UserRepositoryInterface;

class GetOrdersByUserIdAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(ByIdRequest $request): GetOrdersByUserIdResponse
    {
        $user = $this->userRepository->getById($request->getId());

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        $orders = $user->orders;

        return new GetOrdersByUserIdResponse($orders);
    }
}
