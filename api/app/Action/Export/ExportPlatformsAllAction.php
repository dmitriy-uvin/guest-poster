<?php

declare(strict_types=1);

namespace App\Action\Export;

use App\Models\Platform;
use Illuminate\Support\Facades\File;

final class ExportPlatformsAllAction
{
    public function execute()
    {
        if (!file_exists(storage_path('app/public/export'))) {
            mkdir(storage_path('app/public/export'));
        }

        File::put(storage_path('app/public/export/export-all.csv'),'');
        $f = fopen('../storage/app/public/export/export-all.csv', 'a+');
        fputcsv($f, [
            'Protocol',
            'Website Url',
            'Organic Traffic',
            'Dofollow Active',
            'Home Featured Active',
            'Niche Edit Link Price',
            'Niche Edit Link Active',
            'Article Writing Price',
            'Article Requirements',
            'Deadline',
            'Domain Zone',
            'Price',
            'Email',
            'Description',
            'Where Posted',
            'Contacts',
            'Comment',
            'Trust',
            'Spam',
            'lrtPowerTrust',
            'Topics',
            'Alexa Rank',
            'Alexa Country',
            'Alexa Country Rank',
            'Facebook Comments',
            'Facebook Reactions',
            'Facebook Shares',
            'Majestic External Backlinks',
            'Majestic External GOV',
            'Majestic External EDU',
            'Majestic TrustFlow (TF)',
            'Majestic CitationFlow (CF)',
            'Majestic RefD',
            'Majestic RefD EDU',
            'Majestic RefD GOV',
            'MOZ PA',
            'MOZ DA',
            'MOZ Rank',
            'MOZ LinksIN',
            'MOZ Equity',
            'SemRush Rank',
            'SemRush Keyword Num',
            'SemRush Traffic Costs',
        ]);

        $platforms = Platform::all();
        foreach ($platforms as $platform) {
            fputcsv($f, [
                $platform->protocol,
                $platform->website_url,
                $this->returnNotAvailable($platform->organic_traffic),
                $platform->dofollow_active,
                $platform->free_home_featured_active,
                $platform->niche_edit_link_price,
                $platform->niche_edit_link_active,
                $platform->article_writing_price,
                $platform->article_requirements,
                $platform->deadline,
                $platform->domain_zone,
                $platform->price,
                $platform->email,
                $platform->description,
                $platform->where_posted,
                $platform->contacts,
                $platform->comment,
                $this->returnNotAvailable($platform->trust),
                $this->returnNotAvailable($platform->spam),
                $this->returnNotAvailable($platform->lrt_power_trust),
                implode(',', $platform->topics->map(fn($topic) => $topic->name)->all()),
                $this->returnNotAvailable($platform->alexa->rank),
                $this->returnNotAvailable($platform->alexa->country),
                $this->returnNotAvailable($platform->alexa->country_rank),
                $this->returnNotAvailable($platform->facebook->fb_comments),
                $this->returnNotAvailable($platform->facebook->fb_reac),
                $this->returnNotAvailable($platform->facebook->fb_shares),
                $this->returnNotAvailable($platform->majestic->external_backlinks),
                $this->returnNotAvailable($platform->majestic->external_gov),
                $this->returnNotAvailable($platform->majestic->external_edu),
                $this->returnNotAvailable($platform->majestic->tf),
                $this->returnNotAvailable($platform->majestic->cf),
                $this->returnNotAvailable($platform->majestic->refd),
                $this->returnNotAvailable($platform->majestic->refd_edu),
                $this->returnNotAvailable($platform->majestic->refd_gov),
                $this->returnNotAvailable($platform->moz->pa),
                $this->returnNotAvailable($platform->moz->da),
                $this->returnNotAvailable($platform->moz->rank),
                $this->returnNotAvailable($platform->moz->links_in),
                $this->returnNotAvailable($platform->moz->equity),
                $this->returnNotAvailable($platform->semrush->rank),
                $this->returnNotAvailable($platform->semrush->keyword_num),
                $this->returnNotAvailable($platform->semrush->traffic_costs),
            ]);
        }
        fclose($f);
    }

    private function returnNotAvailable($value)
    {
        if (!$value) return 'N/A';
        return $value;
    }
}
