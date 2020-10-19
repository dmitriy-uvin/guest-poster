<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

final class CheckTrustService
{
    private string $checkTrustApiEndpoint = 'https://checktrust.ru/app.php?r=host/app/summary/basic&applicationKey=';
    private string $checkTrustApiKey = 'a0aece19412bc5f00b4e595fbd158fb4';
    private array $params = [
        'trust',
        'spam',
        'lrtPowerTrust'
    ];

    public function getDataFromApiByPlatform(string $platform)
    {
        $paramsString = implode(',', $this->params);

        $url = $this->checkTrustApiEndpoint .
            $this->checkTrustApiKey . '&host=' .
            $platform . '&parameterList=' . $paramsString;

        return Http::get($url)->object();
    }
}
