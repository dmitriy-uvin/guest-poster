<?php

declare(strict_types=1);

namespace App\Repositories\Order;

use App\Contracts\EloquentCriterion;
use App\Models\Order;
use Illuminate\Support\Collection;

final class OrderRepository implements OrderRepositoryInterface
{
    public const DEFAULT_SORTING = 'id';
    public const DEFAULT_DIRECTION = 'asc';

    public function getById(int $id): ?Order
    {
        return Order::find($id);
    }

    public function save(Order $order): Order
    {
        $order->save();
        return $order;
    }

    public function delete(Order $order): void
    {
        $order->delete();
    }

    public function getAll(): Collection
    {
        return Order::all();
    }

    public function findByCriteria(EloquentCriterion ...$criteria)
    {
        $query = Order::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->build($query);
        }

        return $query->get();
    }

    public function findOneByCriteria(EloquentCriterion ...$criteria): ?Order
    {
        $query = Order::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->build($query);
        }

        return $query->get()->first();
    }
}
