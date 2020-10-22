<?php

declare(strict_types=1);

namespace App\Action\Platform;

final class GetPlatformCollectionRequest
{
    private ?int $page;
    private ?int $perPage;
    private ?string $sorting;
    private ?string $direction;

    //Platform
    private ?int $organicTrafficFrom;
    private ?int $organicTrafficTo;
    private ?float $priceFrom;
    private ?float $priceTo;
    private ?int $deadline;

    private string $dofollow;
    private string $nicheEditLink;
    private string $homeFeatured;
    private string $moneyAnchor;

    private ?array $topics;
    private ?array $domainZones;

    // MOZ
    private ?int $mozDaFrom;
    private ?int $mozDaTo;
    private ?int $mozPaFrom;
    private ?int $mozPaTo;
    private ?int $mozRankFrom;
    private ?int $mozRankTo;
    private ?int $mozLinksInFrom;
    private ?int $mozLinksInTo;
    private ?int $mozEquityFrom;
    private ?int $mozEquityTo;

    // Alexa
    private ?array $alexaCountries;
    private ?int $alexaRankFrom;
    private ?int $alexaRankTo;
    private ?int $alexaCountryRankFrom;
    private ?int $alexaCountryRankTo;

    // Majestic
    private ?int $majesticExtBacklinksFrom;
    private ?int $majesticExtBacklinksTo;
    private ?int $majesticExtGovFrom;
    private ?int $majesticExtGovTo;
    private ?int $majesticExtEduFrom;
    private ?int $majesticExtEduTo;
    private ?int $majesticRefDFrom;
    private ?int $majesticRefDTo;
    private ?int $majesticRefDGovFrom;
    private ?int $majesticRefDGovTo;
    private ?int $majesticRefDEduFrom;
    private ?int $majesticRefDEduTo;
    private ?int $majesticTfFrom;
    private ?int $majesticTfTo;
    private ?int $majesticCfFrom;
    private ?int $majesticCfTo;

    // SemRush
    private ?int $semRushRankFrom;
    private ?int $semRushRankTo;
    private ?int $semRushKeywordNumFrom;
    private ?int $semRushKeywordNumTo;
    private ?int $semRushTrafficCostsFrom;
    private ?int $semRushTrafficCostsTo;

    // Facebook
    private ?int $facebookCommentsFrom;
    private ?int $facebookCommentsTo;
    private ?int $facebookSharesFrom;
    private ?int $facebookSharesTo;
    private ?int $facebookReactionsFrom;
    private ?int $facebookReactionsTo;

    // Ahrefs
    private ?int $ahrefsRankFrom;
    private ?int $ahrefsRankTo;
    private ?int $ahrefsDrFrom;
    private ?int $ahrefsDrTo;
    private ?int $ahrefsExtBacklinksFrom;
    private ?int $ahrefsExtBacklinksTo;
    private ?int $ahrefsRefDFrom;
    private ?int $ahrefsRefDTo;
    private ?int $ahrefsDofollowFrom;
    private ?int $ahrefsDofollowTo;

    // Trust
    private ?int $checkTrustFrom;
    private ?int $checkTrustTo;
    private ?int $spamFrom;
    private ?int $spamTo;
    private ?int $powerTrustFrom;
    private ?int $powerTrustTo;

    private ?array $summary;

    public function __construct(
        ?int $page,
        ?int $perPage,
        ?string $sorting,
        ?string $direction,
        array $filter
    ) {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->sorting = $sorting;
        $this->direction = $direction;

        $this->organicTrafficFrom = (int)$filter['platform']['organic_traffic_from'];
        $this->organicTrafficTo = (int)$filter['platform']['organic_traffic_to'];
        $this->priceFrom = (float)$filter['platform']['price_from'];
        $this->priceTo = (float)$filter['platform']['price_to'];
        $this->deadline = (int)$filter['platform']['deadline'];
        $this->domainZones = $filter['platform']['domainZones'];
        $this->topics = $filter['platform']['topics'];

        $this->dofollow = $filter['platform']['dofollow'];
        $this->nicheEditLink = $filter['platform']['niche_edit_link'];
        $this->homeFeatured = $filter['platform']['home_featured'];
        $this->moneyAnchor = $filter['platform']['money_anchor'];

        $this->mozDaFrom = (int)$filter['moz']['da_from'];
        $this->mozDaTo = (int)$filter['moz']['da_to'];
        $this->mozPaFrom = (int)$filter['moz']['pa_from'];
        $this->mozPaTo = (int)$filter['moz']['pa_to'];
        $this->mozRankFrom = (int)$filter['moz']['rank_from'];
        $this->mozRankTo = (int)$filter['moz']['rank_to'];
        $this->mozLinksInFrom = (int)$filter['moz']['links_in_from'];
        $this->mozLinksInTo = (int)$filter['moz']['links_in_to'];
        $this->mozEquityFrom = (int)$filter['moz']['equity_from'];
        $this->mozEquityTo = (int)$filter['moz']['equity_to'];

        $this->alexaRankFrom = (int)$filter['alexa']['rank_from'];
        $this->alexaRankTo = (int)$filter['alexa']['rank_to'];
        $this->alexaCountries = $filter['alexa']['country'];
        $this->alexaCountryRankFrom = (int)$filter['alexa']['country_rank_from'];
        $this->alexaCountryRankTo = (int)$filter['alexa']['country_rank_to'];

        $this->majesticCfFrom = (int)$filter['majestic']['cf_from'];
        $this->majesticCfTo = (int)$filter['majestic']['cf_to'];
        $this->majesticTfFrom = (int)$filter['majestic']['tf_from'];
        $this->majesticTfTo = (int)$filter['majestic']['tf_to'];
        $this->majesticExtBacklinksFrom = (int)$filter['majestic']['external_backlinks_from'];
        $this->majesticExtBacklinksTo = (int)$filter['majestic']['external_backlinks_to'];
        $this->majesticExtEduFrom = (int)$filter['majestic']['external_edu_from'];
        $this->majesticExtEduTo = (int)$filter['majestic']['external_edu_to'];
        $this->majesticExtGovFrom = (int)$filter['majestic']['external_gov_from'];
        $this->majesticExtGovTo = (int)$filter['majestic']['external_gov_to'];
        $this->majesticRefDFrom = (int)$filter['majestic']['refd_from'];
        $this->majesticRefDTo = (int)$filter['majestic']['refd_to'];
        $this->majesticRefDEduFrom = (int)$filter['majestic']['refd_edu_from'];
        $this->majesticRefDEduTo = (int)$filter['majestic']['refd_edu_to'];
        $this->majesticRefDGovFrom = (int)$filter['majestic']['refd_gov_from'];
        $this->majesticRefDGovTo = (int)$filter['majestic']['refd_gov_to'];

        $this->semRushRankFrom = (int)$filter['semRush']['rank_from'];
        $this->semRushRankTo = (int)$filter['semRush']['rank_to'];
        $this->semRushKeywordNumFrom = (int)$filter['semRush']['keyword_num_from'];
        $this->semRushKeywordNumTo = (int)$filter['semRush']['keyword_num_to'];
        $this->semRushTrafficCostsFrom = (int)$filter['semRush']['traffic_costs_from'];
        $this->semRushTrafficCostsTo = (int)$filter['semRush']['traffic_costs_to'];

        $this->facebookCommentsFrom = (int)$filter['facebook']['comments_from'];
        $this->facebookCommentsTo = (int)$filter['facebook']['comments_to'];
        $this->facebookReactionsFrom = (int)$filter['facebook']['reactions_from'];
        $this->facebookReactionsTo = (int)$filter['facebook']['reactions_to'];
        $this->facebookSharesFrom = (int)$filter['facebook']['shares_from'];
        $this->facebookSharesTo = (int)$filter['facebook']['shares_to'];

        $this->ahrefsRankFrom = (int)$filter['ahrefs']['rank_from'];
        $this->ahrefsRankTo = (int)$filter['ahrefs']['rank_to'];
        $this->ahrefsDrFrom = (int)$filter['ahrefs']['dr_from'];
        $this->ahrefsDrTo = (int)$filter['ahrefs']['dr_to'];
        $this->ahrefsExtBacklinksFrom = (int)$filter['ahrefs']['ext_backlinks_from'];
        $this->ahrefsExtBacklinksTo = (int)$filter['ahrefs']['ext_backlinks_to'];
        $this->ahrefsRefDFrom = (int)$filter['ahrefs']['refd_from'];
        $this->ahrefsRefDTo = (int)$filter['ahrefs']['refd_to'];
        $this->ahrefsDofollowFrom = (int)$filter['ahrefs']['dofollow_from'];
        $this->ahrefsDofollowTo = (int)$filter['ahrefs']['dofollow_to'];

        $this->checkTrustFrom = (int)$filter['trust']['checktrust_from'];
        $this->checkTrustTo = (int)$filter['trust']['checktrust_to'];
        $this->spamFrom = (int)$filter['trust']['spam_from'];
        $this->spamTo = (int)$filter['trust']['spam_to'];
        $this->powerTrustFrom = (int)$filter['trust']['powertrust_from'];
        $this->powerTrustTo = (int)$filter['trust']['powertrust_to'];
        $this->summary = $filter['trust']['summary'];
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    public function getSorting(): ?string
    {
        return $this->sorting;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function getOrganicTrafficFrom(): ?int
    {
        return $this->organicTrafficFrom;
    }

    public function getOrganicTrafficTo(): ?int
    {
        return $this->organicTrafficTo;
    }

    public function getPriceFrom(): ?float
    {
        return $this->priceFrom;
    }

    public function getPriceTo(): ?float
    {
        return $this->priceTo;
    }

    public function getDeadline(): ?int
    {
        return $this->deadline;
    }

    public function getDofollow(): string
    {
        return $this->dofollow;
    }

    public function getNicheEditLink(): string
    {
        return $this->nicheEditLink;
    }

    public function getHomeFeatured(): string
    {
        return $this->homeFeatured;
    }

    public function getMoneyAnchor(): string
    {
        return $this->moneyAnchor;
    }

    public function getTopics(): ?array
    {
        return $this->topics;
    }

    public function getDomainZones(): ?array
    {
        return $this->domainZones;
    }

    public function getMozDaFrom(): ?int
    {
        return $this->mozDaFrom;
    }

    public function getMozDaTo(): ?int
    {
        return $this->mozDaTo;
    }

    public function getMozPaFrom(): ?int
    {
        return $this->mozPaFrom;
    }

    public function getMozPaTo(): ?int
    {
        return $this->mozPaTo;
    }

    public function getMozRankFrom(): ?int
    {
        return $this->mozRankFrom;
    }

    public function getMozRankTo(): ?int
    {
        return $this->mozRankTo;
    }

    public function getMozLinksInFrom(): ?int
    {
        return $this->mozLinksInFrom;
    }

    public function getMozLinksInTo(): ?int
    {
        return $this->mozLinksInTo;
    }

    public function getMozEquityFrom(): ?int
    {
        return $this->mozEquityFrom;
    }

    public function getMozEquityTo(): ?int
    {
        return $this->mozEquityTo;
    }

    public function getAlexaCountries(): ?array
    {
        return $this->alexaCountries;
    }

    public function getAlexaRankFrom(): ?int
    {
        return $this->alexaRankFrom;
    }

    public function getAlexaRankTo(): ?int
    {
        return $this->alexaRankTo;
    }

    public function getAlexaCountryRankFrom(): ?int
    {
        return $this->alexaCountryRankFrom;
    }

    public function getAlexaCountryRankTo(): ?int
    {
        return $this->alexaCountryRankTo;
    }

    public function getMajesticExtBacklinksFrom(): ?int
    {
        return $this->majesticExtBacklinksFrom;
    }

    public function getMajesticExtBacklinksTo(): ?int
    {
        return $this->majesticExtBacklinksTo;
    }

    public function getMajesticExtGovFrom(): ?int
    {
        return $this->majesticExtGovFrom;
    }

    public function getMajesticExtGovTo(): ?int
    {
        return $this->majesticExtGovTo;
    }

    public function getMajesticExtEduFrom(): ?int
    {
        return $this->majesticExtEduFrom;
    }

    public function getMajesticExtEduTo(): ?int
    {
        return $this->majesticExtEduTo;
    }

    public function getMajesticRefDFrom(): ?int
    {
        return $this->majesticRefDFrom;
    }

    public function getMajesticRefDTo(): ?int
    {
        return $this->majesticRefDTo;
    }

    public function getMajesticRefDGovFrom(): ?int
    {
        return $this->majesticRefDGovFrom;
    }

    public function getMajesticRefDGovTo(): ?int
    {
        return $this->majesticRefDGovTo;
    }

    public function getMajesticRefDEduFrom(): ?int
    {
        return $this->majesticRefDEduFrom;
    }

    public function getMajesticRefDEduTo(): ?int
    {
        return $this->majesticRefDEduTo;
    }

    public function getMajesticTfFrom(): ?int
    {
        return $this->majesticTfFrom;
    }

    public function getMajesticTfTo(): ?int
    {
        return $this->majesticTfTo;
    }

    public function getMajesticCfFrom(): ?int
    {
        return $this->majesticCfFrom;
    }

    public function getMajesticCfTo(): ?int
    {
        return $this->majesticCfTo;
    }

    public function getSemRushRankFrom(): ?int
    {
        return $this->semRushRankFrom;
    }

    public function getSemRushRankTo(): ?int
    {
        return $this->semRushRankTo;
    }

    public function getSemRushKeywordNumFrom(): ?int
    {
        return $this->semRushKeywordNumFrom;
    }

    public function getSemRushKeywordNumTo(): ?int
    {
        return $this->semRushKeywordNumTo;
    }

    public function getSemRushTrafficCostsFrom(): ?int
    {
        return $this->semRushTrafficCostsFrom;
    }

    public function getSemRushTrafficCostsTo(): ?int
    {
        return $this->semRushTrafficCostsTo;
    }

    public function getFacebookCommentsFrom(): ?int
    {
        return $this->facebookCommentsFrom;
    }

    public function getFacebookCommentsTo(): ?int
    {
        return $this->facebookCommentsTo;
    }

    public function getFacebookSharesFrom(): ?int
    {
        return $this->facebookSharesFrom;
    }

    public function getFacebookSharesTo(): ?int
    {
        return $this->facebookSharesTo;
    }

    public function getFacebookReactionsFrom(): ?int
    {
        return $this->facebookReactionsFrom;
    }

    public function getFacebookReactionsTo(): ?int
    {
        return $this->facebookReactionsTo;
    }

    public function getAhrefsRankFrom(): ?int
    {
        return $this->ahrefsRankFrom;
    }

    public function getAhrefsRankTo(): ?int
    {
        return $this->ahrefsRankTo;
    }

    public function getAhrefsDrFrom(): ?int
    {
        return $this->ahrefsDrFrom;
    }

    public function getAhrefsDrTo(): ?int
    {
        return $this->ahrefsDrTo;
    }

    public function getAhrefsExtBacklinksFrom(): ?int
    {
        return $this->ahrefsExtBacklinksFrom;
    }

    public function getAhrefsExtBacklinksTo(): ?int
    {
        return $this->ahrefsExtBacklinksTo;
    }

    public function getAhrefsRefDFrom(): ?int
    {
        return $this->ahrefsRefDFrom;
    }

    public function getAhrefsRefDTo(): ?int
    {
        return $this->ahrefsRefDTo;
    }

    public function getAhrefsDofollowFrom(): ?int
    {
        return $this->ahrefsDofollowFrom;
    }

    public function getAhrefsDofollowTo(): ?int
    {
        return $this->ahrefsDofollowTo;
    }

    public function getCheckTrustFrom(): ?int
    {
        return $this->checkTrustFrom;
    }

    public function getCheckTrustTo(): ?int
    {
        return $this->checkTrustTo;
    }

    public function getSpamFrom(): ?int
    {
        return $this->spamFrom;
    }

    public function getSpamTo(): ?int
    {
        return $this->spamTo;
    }

    public function getPowerTrustFrom(): ?int
    {
        return $this->powerTrustFrom;
    }

    public function getPowerTrustTo(): ?int
    {
        return $this->powerTrustTo;
    }

    public function getSummary(): ?array
    {
        return $this->summary;
    }
}
