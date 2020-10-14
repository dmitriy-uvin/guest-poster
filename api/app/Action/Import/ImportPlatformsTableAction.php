<?php

declare(strict_types=1);

namespace App\Action\Import;

use App\Services\CheckTrustService;
use App\Services\SeoRankService;
use Illuminate\Support\Facades\Storage;

class ImportPlatformsTableAction
{
    private SeoRankService $seoRankService;

    public function __construct()
    {
        $this->seoRankService = new SeoRankService();
    }

    public function execute(ImportPlatformsTableRequest $request)
    {
        $filePath = $this->storeFile($request->getFile());
        $platformsData = $this->parseCSVFile($filePath);
        $fullPlatformsData = $this->getDataForPlatformsFromAPI($platformsData);

        return new ImportPlatformsTableResponse([
            'data' => $fullPlatformsData[0]['api1']
        ]);
    }

    private function getDataForPlatformsFromAPI(array $platforms)
    {
        foreach ($platforms as $index => $platform) {
            $platforms[$index]['api1'] =
                $this->seoRankService->getDataForMozAlexaSemRushFb(
                    $platform['website_url']
                );
        }
        return $platforms;
    }

    private function storeFile($file): string
    {
        $extension = $file->getClientOriginalExtension();
        $originalTmpName = $file->getFilename();
        $originalName = $file->getClientOriginalName();
        $fileName = $originalName . '-' . $originalTmpName . '.' . $extension;
        return Storage::putFileAs(
            'public/import',
            $file,
            $fileName
        );
    }

    private function parseCSVFile(string $filePath): array
    {
        $fHandle = fopen('../storage/app/' . $filePath, 'r');
        $platformsData = [];
        $fieldKeys = [];
        $row = 0;
        while (($line = fgets($fHandle)) !== false) {
            if ($row === 0) {
                $fieldKeys = str_getcsv($line);
            } else {
                $platformsData[] = array_combine($fieldKeys, str_getcsv($line));
            }
            $row += 1;
        }
        fclose($fHandle);

        return $platformsData;
    }
}
