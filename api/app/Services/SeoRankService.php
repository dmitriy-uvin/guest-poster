<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

final class SeoRankService
{
    private string $SEORANK_API_MOZ_ALEXA_SEMRUSH_FB = 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/';
    private string $SEORANK_API_MAJESTIC = 'https://seo-rank.my-addr.com/api4/';

    public function getDataForMozAlexaSemRushFb(string $platform)
    {
        $url = $this->SEORANK_API_MOZ_ALEXA_SEMRUSH_FB . env("SEO_RANK_API_KEY") . '/' . $platform;
//        $response = Http::get($url);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }

    public function getDataForMajestic(string $platform)
    {
        $url = $this->SEORANK_API_MAJESTIC . env("SEO_RANK_API_KEY") . '/' . $platform;
        $response = Http::get($url);
        return $response->object();
    }
}
