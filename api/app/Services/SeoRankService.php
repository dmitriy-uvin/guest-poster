<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

final class SeoRankService
{
    private string $SEORANK_API_MOZ_ALEXA_SEMRUSH_FB = 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/98DBBAF083E292FD329F2DB78A60C3F5/';
    private string $SEORANK_API_MAJESTIC = 'https://seo-rank.my-addr.com/api4/98DBBAF083E292FD329F2DB78A60C3F5/';

    public function getDataForMozAlexaSemRushFb(string $platform)
    {
        $url = $this->SEORANK_API_MOZ_ALEXA_SEMRUSH_FB . $platform;
        $response = Http::get($url);
        return $response->object();
    }

    public function getDataForMajestic(string $platform)
    {
        $url = $this->SEORANK_API_MAJESTIC . $platform;
        $response = Http::get($url);
        return $response->object();
    }
}
