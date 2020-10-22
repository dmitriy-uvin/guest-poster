<?php

namespace App\Constants;

final class PlatformTrustSummary
{
    public const BAD = 'bad';
    public const GOOD = 'good';
    public const PERFECT = 'perfect';
    public static function all()
    {
        return [
            self::BAD,
            self::GOOD,
            self::PERFECT,
        ];
    }
}
