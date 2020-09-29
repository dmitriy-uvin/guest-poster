<?php

declare(strict_types=1);

namespace App\Repositories\Order;

use App\Contracts\EloquentCriterion;
use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function getById(int $id): ?Order;
    public function save(Order $order): Order;
    public function delete(Order $order): void;
    public function getAll(): Collection;
    public function findByCriteria(EloquentCriterion ...$criteria);
    public function findOneByCriteria(EloquentCriterion ...$criteria): ?Order;
}
