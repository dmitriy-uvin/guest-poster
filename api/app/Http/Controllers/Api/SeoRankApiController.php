<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

final class SeoRankApiController extends ApiController
{
    private const SEORANK_API_MOZ_ALEXA_SEMRUSH = 'https://seo-rank.my-addr.com/api2/moz+alexa+sr+fb/';
    private const SEORANK_API_MAJESTIC = 'https://seo-rank.my-addr.com/api4/';

    public function fetchInformationByDomainMozAlexaSr(Request $request)
    {
        $domain = $request->query('protocol') . "://" . $request->query('domain');
        $url = self::SEORANK_API_MOZ_ALEXA_SEMRUSH . env('SEO_RANK_API_KEY') . '/' . $domain;
//        $response = Http::get($url);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }

    public function fetchInformationByDomainMajestic(Request $request)
    {
        $domain = $request->query('protocol') . "://" . $request->query('domain');
        $url = self::SEORANK_API_MAJESTIC . env('SEO_RANK_API_KEY') . '/' . $domain;
        $response = Http::get($url);

        return $response;
    }
}
