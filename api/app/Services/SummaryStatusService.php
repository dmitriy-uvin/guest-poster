<?php

namespace App\Services;

class SummaryStatusService
{
    private const PERFECT = 'perfect';
    private const GOOD = 'good';
    private const BAD = 'bad';

    private static array $threeCharacteristics = [
        'PPP' => 'P',
        'GGG' => 'G',
        'GPP' => 'P',
        'BPP' => 'G',
        'GGP' => 'G',
        'BBP' => 'G',
        'BGP' => 'G',
        'BGG' => 'G',
        'BBG' => 'B',
        'BBB' => 'B',
    ];
    private static array $twoCharacteristics = [
        'PP' => 'P',
        'GP' => 'G',
        'BP' => 'G',
        'GG' => 'G',
        'BG' => 'G',
        'BB' => 'B',
    ];

    private static array $keyNames = [
        'P' => self::PERFECT,
        'G' => self::GOOD,
        'B' => self::BAD,
        'N/A' => null
    ];

    public static function getSummaryStatus(?int $trust, ?int $spam, ?int $powerTrust): ?string
    {
        $summaryStatusKey = null;
        $summaryStatus = null;
        $key = [];

        if ($trust !== null) {
            if ($trust >= 0 && $trust <= 30) {
                $key[] = 'B';
            } else if ($trust >= 31 && $trust <= 50) {
                $key[] = 'G';
            } else if ($trust >= 51 && $trust <= 100) {
                $key[] = 'P';
            }
        }
        if ($spam !== null) {
            if ($spam >= 21 && $spam <= 100) {
                $key[] = 'B';
            } else if ($spam >= 6 && $spam <= 20) {
                $key[] = 'G';
            } else if ($spam >= 0 && $spam <= 5) {
                $key[] = 'P';
            }
        }

        if ($powerTrust !== null) {
            if ($powerTrust >= 0 && $powerTrust <= 10) {
                $key[] = 'B';
            } else if ($powerTrust >= 11 && $powerTrust <= 30) {
                $key[] = 'G';
            } else if ($powerTrust >= 31 && $powerTrust <= 100) {
                $key[] = 'P';
            }
        }
        sort($key);
        $keyString = implode('', $key);
        if (mb_strlen($keyString) === 3) {
            $summaryStatusKey = self::$threeCharacteristics[$keyString];
            $summaryStatus = self::$keyNames[$summaryStatusKey];
        } else if (mb_strlen($keyString) === 2) {
            $summaryStatusKey = self::$twoCharacteristics[$keyString];
            $summaryStatus = self::$keyNames[$summaryStatusKey];
        } else {
            $summaryStatusKey = 'N/A';
            $summaryStatus = self::$keyNames[$summaryStatusKey];
        }

        return $summaryStatus;
    }
}
