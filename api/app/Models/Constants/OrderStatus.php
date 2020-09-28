<?php

declare(strict_types=1);

namespace App\Models\Constants;

final class OrderStatus
{
    public const NEW = 'New';
    public const IN_PROCESS = 'In process';
    public const CANCELED = 'Canceled';
    public const COMPLETED = 'Completed';

    public static function getAllStatuses()
    {
        return [
            self::NEW,
            self::IN_PROCESS,
            self::CANCELED,
            self::COMPLETED
        ];
    }
}
