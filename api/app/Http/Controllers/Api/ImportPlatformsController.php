<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\Import\ImportPlatformsTableAction;
use App\Action\Import\ImportPlatformsTableRequest;
use App\Http\Requests\Platform\UploadPlatformsTableHttpRequest;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

final class ImportPlatformsController extends ApiController
{
    private ImportPlatformsTableAction $importPlatformsTableAction;

    public function __construct(ImportPlatformsTableAction $importPlatformsTableAction)
    {
        $this->importPlatformsTableAction = $importPlatformsTableAction;
    }

    public function importPlatforms(UploadPlatformsTableHttpRequest $request)
    {
        $response = $this->importPlatformsTableAction->execute(
            new ImportPlatformsTableRequest(
                $request->file('platforms_table')
            )
        );

        return $this->successResponse($response->getResponse());
    }

    public function downloadImportFileTemplate()
    {
        if (!file_exists(storage_path('app/public/import'))) {
            mkdir(storage_path('app/public/import'));
        }
        File::put(storage_path('app/public/import/import-platforms-template.csv'),'');
        $f = fopen('../storage/app/public/import/import-platforms-template.csv', 'a+');
        fputcsv($f, [
            'protocol',
            'website_url',
            'domain_zone',
            'topics',
            'description',
            'article_requirements',
            'where_posted',
            'deadline',
            'dofollow_active',
            'money_anchor',
            'free_home_featured_active',
            'niche_edit_link_active',
            'price',
            'article_writing_price',
            'niche_edit_link_price',
            'email',
            'contacts',
            'comment',
        ], ';');
        fclose($f);

        return Storage::download('public/import/import-platforms-template.csv', 'import__template.csv');
    }
}
