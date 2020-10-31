<?php

declare(strict_types=1);

namespace App\Action\Import;

use App\Constants\ImportFields;
use App\Events\PlatformImportCreatedEvent;
use App\Exceptions\Import\AnyPlatformsInFileException;
use App\Exceptions\Import\ImportFieldsRequiredException;
use App\Exceptions\Import\WrongImportValueException;
use App\Jobs\GetDataFromApiForPlatformsImport;
use App\Jobs\UpdateDataFromApiForPlatformsImport;
use App\Models\Constants\JobConstants;
use App\Services\SeoRankService;
use Illuminate\Support\Facades\Storage;

final class ImportPlatformsTableAction
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

        if (!count($platformsData)) {
            throw new AnyPlatformsInFileException();
        }

        $this->validatePlatformsFromCSV($platformsData);

        $platformsData = $this->convertEmptyFieldsToNull($platformsData);

        $this->getDataFromApi($platformsData);

        $this->deleteFile($request->getFile());

        return new ImportPlatformsTableResponse(
            ['data' => 1]
        );
    }

    private function getDataFromApi(array $platforms)
    {
        $chunkSize = JobConstants::CHUNK_SIZE;
        $chunkedPlatforms = collect($platforms)->chunk($chunkSize);
        foreach ($chunkedPlatforms as $index => $platformsDataSet) {
            $row = 1 + $index * ($chunkSize + 1);
            GetDataFromApiForPlatformsImport::dispatch($platformsDataSet->toArray(), $row);
        }
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
                $fieldKeys = str_getcsv($line, ';');
            } else {
                $platformsData[] = array_combine($fieldKeys, str_getcsv($line, ';'));
            }
            $row += 1;
        }

        foreach (ImportFields::getFields() as $field) {
            if (!in_array($field, $fieldKeys)) {
                throw new ImportFieldsRequiredException($field);
            }
        }
        fclose($fHandle);

        return $platformsData;
    }

    private function validatePlatformsFromCSV($platformsData)
    {
        $row = 1;
        foreach ($platformsData as $index => $platformData) {
            foreach ($platformData as $columnName => $value) {
                switch ($columnName) {
                    case 'protocol':
                    case 'website_url':
                    case 'topics':
                    case 'description':
                    case 'article_requirements':
                    case 'where_posted':
                    case 'domain_zone':
                        if (!$value) {
                            throw new WrongImportValueException($row, $columnName, 'Empty field');
                        }
                        break;
                    case 'deadline':
                        if (!(int)$value) {
                            throw new WrongImportValueException($row, $columnName);
                        }
                        if ((int)$value < 1 || (int)$value > 60) {
                            throw new WrongImportValueException($row, $columnName, 'Deadline must be between 1 and 60 days');
                        }
                        break;
                    case 'dofollow_active':
                    case 'home_featured_active':
                    case 'niche_edit_link_active':
                    case 'money_anchor':
                        if ((int)$value !== 0 && (int)$value !== 1) {
                            throw new WrongImportValueException($row, $columnName);
                        }
                        break;
                    case 'price':
                        if (is_numeric($value)) {
                            if ((int)$value < 0) {
                                throw new WrongImportValueException($row, $columnName, "Price can't be less than 0");
                            }
                        } else {
                            throw new WrongImportValueException($row, $columnName, "Price must be numeric");
                        }
                        break;
                    case 'article_writing_price':
                    case 'niche_edit_link_price':
                        if ($value) {
                            if (!is_numeric($value)) {
                                throw new WrongImportValueException($row, $columnName, "Niche Edit Price must be numeric");
                            }
                        }
                        break;
                    case 'email':
                        if (!$value) {
                            throw new WrongImportValueException($row, $columnName, "Email value is required");
                        }
                        break;
                }
            }
            $row += 1;
        }

        return true;
    }

    private function convertEmptyFieldsToNull(array $platformsData)
    {
        foreach ($platformsData as $index => $platform) {
            foreach ($platform as $field => $value) {
                if ($value === '') {
                    $platformsData[$index][$field] = null;
                }
            }
        }
        return $platformsData;
    }

    private function deleteFile($file)
    {
        $extension = $file->getClientOriginalExtension();
        $originalTmpName = $file->getFilename();
        $originalName = $file->getClientOriginalName();
        $fileName = $originalName . '-' . $originalTmpName . '.' . $extension;
        Storage::delete(['public/import/' . $fileName]);
    }
}
