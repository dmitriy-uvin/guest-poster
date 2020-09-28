<?php

namespace App\Http\Requests\Order;

final class OrderTypes
{
    public const GUEST_POSTING = 'Guest Posting';

    public static function getAllTypes()
    {
        return [
            self::GUEST_POSTING
        ];
    }
}
