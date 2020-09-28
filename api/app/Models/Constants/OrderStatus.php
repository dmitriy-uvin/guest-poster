<?php

declare(strict_types=1);

namespace App\Models\Constants;

final class OrderStatus
{
    public const NEW = 'new';
    public const IN_PROCESS = 'in_process';
    public const CANCELED = 'canceled';
    public const COMPLETED = 'completed';
}
