<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

final class CheckTrustService
{
    private string $checkTrustApiEndpoint = 'https://checktrust.ru/app.php?r=host/app/summary/basic&applicationKey=';
    private array $params = [
        'trust',
        'spam',
        'lrtPowerTrust'
    ];

    public function getDataFromApiByPlatform(string $platform)
    {
        $paramsString = implode(',', $this->params);

        $url = $this->checkTrustApiEndpoint .
            env('CHECK_TRUST_API_KEY') . '&host=' .
            $platform . '&parameterList=' . $paramsString;
        $response = Http::get($url);
        return $response->object();
    }
}
