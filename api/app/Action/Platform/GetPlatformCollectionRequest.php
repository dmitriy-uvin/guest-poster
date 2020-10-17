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
    private ?int $drFrom;
    private ?int $drTo;
    private ?int $maFrom;
    private ?int $maTo;
    private ?int $organicTrafficFrom;
    private ?int $organicTrafficTo;
    private ?float $priceFrom;
    private ?float $priceTo;

    private string $dofollow;
    private string $nicheEditLink;
    private string $homeFeatured;

    // MOZ
    private ?int $mozDaFrom;
    private ?int $mozDaTo;
    private ?int $mozPaFrom;
    private ?int $mozPaTo;
    private ?float $mozRankFrom;
    private ?float $mozRankTo;
    private ?int $mozLinksInFrom;
    private ?int $mozLinksInTo;

    // Alexa
    private ?string $alexaCountry;
    private ?float $alexaRankFrom;
    private ?float $alexaRankTo;

    // Majestic
    private ?int $majesticTfFrom;
    private ?int $majesticTfTo;
    private ?int $majesticCfFrom;
    private ?int $majesticCfTo;
    private ?int $majesticExtBacklinksFrom;
    private ?int $majesticExtBacklinksTo;
    private ?int $majesticExtGovFrom;
    private ?int $majesticExtGovTo;
    private ?int $majesticExtEduFrom;
    private ?int $majesticExtEduTo;

    // SemRush
    private ?float $semRushRankFrom;
    private ?float $semRushRankTo;
    private ?int $semRushKeywordNumFrom;
    private ?int $semRushKeywordNumTo;
    private ?int $semRushTrafficFrom;
    private ?int $semRushTrafficTo;
    private ?int $semRushTrafficCostsFrom;
    private ?int $semRushTrafficCostsTo;

    private ?array $topics;

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

        $this->drFrom = (int)$filter['platform']['dr_from'];
        $this->drTo = (int)$filter['platform']['dr_to'];
        $this->maFrom = (int)$filter['platform']['ma_from'];
        $this->maTo = (int)$filter['platform']['ma_to'];
        $this->organicTrafficFrom = (int)$filter['platform']['organic_traffic_from'];
        $this->organicTrafficTo = (int)$filter['platform']['organic_traffic_to'];
        $this->priceFrom = (float)$filter['platform']['price_from'];
        $this->priceTo = (float)$filter['platform']['price_to'];

        $this->dofollow = $filter['dofollow'];
        $this->nicheEditLink = $filter['niche_edit_link'];
        $this->homeFeatured = $filter['home_featured'];

        $this->mozDaFrom = (int)$filter['moz']['da_from'];
        $this->mozDaTo = (int)$filter['moz']['da_to'];
        $this->mozPaFrom = (int)$filter['moz']['pa_from'];
        $this->mozPaTo = (int)$filter['moz']['pa_to'];
        $this->mozRankFrom = (float)$filter['moz']['rank_from'];
        $this->mozRankTo = (float)$filter['moz']['rank_to'];
        $this->mozLinksInFrom = (int)$filter['moz']['links_in_from'];
        $this->mozLinksInTo = (int)$filter['moz']['links_in_to'];

        $this->alexaRankFrom = (float)$filter['alexa']['rank_from'];
        $this->alexaRankTo = (float)$filter['alexa']['rank_to'];
        $this->alexaCountry = $filter['alexa']['country'];

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

        $this->semRushRankFrom = (float)$filter['semRush']['rank_from'];
        $this->semRushRankTo = (float)$filter['semRush']['rank_to'];
        $this->semRushKeywordNumFrom = (int)$filter['semRush']['keyword_num_from'];
        $this->semRushKeywordNumTo = (int)$filter['semRush']['keyword_num_to'];
        $this->semRushTrafficFrom = (int)$filter['semRush']['traffic_from'];
        $this->semRushTrafficTo = (int)$filter['semRush']['traffic_to'];
        $this->semRushTrafficCostsFrom = (int)$filter['semRush']['traffic_costs_from'];
        $this->semRushTrafficCostsTo = (int)$filter['semRush']['traffic_costs_to'];

        $this->topics = $filter['topics'];
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

    public function getDrFrom(): ?int
    {
        return $this->drFrom;
    }

    public function getDrTo(): ?int
    {
        return $this->drTo;
    }

    public function getMaFrom(): ?int
    {
        return $this->maFrom;
    }

    public function getMaTo(): ?int
    {
        return $this->maTo;
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

    public function getMozRankFrom(): ?float
    {
        return $this->mozRankFrom;
    }

    public function getMozRankTo(): ?float
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

    public function getAlexaCountry(): ?string
    {
        return $this->alexaCountry;
    }

    public function getAlexaRankFrom(): ?float
    {
        return $this->alexaRankFrom;
    }

    public function getAlexaRankTo(): ?float
    {
        return $this->alexaRankTo;
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

    public function getSemRushRankFrom(): ?float
    {
        return $this->semRushRankFrom;
    }

    public function getSemRushRankTo(): ?float
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

    public function getSemRushTrafficFrom(): ?int
    {
        return $this->semRushTrafficFrom;
    }

    public function getSemRushTrafficTo(): ?int
    {
        return $this->semRushTrafficTo;
    }

    public function getSemRushTrafficCostsFrom(): ?int
    {
        return $this->semRushTrafficCostsFrom;
    }

    public function getSemRushTrafficCostsTo(): ?int
    {
        return $this->semRushTrafficCostsTo;
    }

    public function getTopics(): ?array
    {
        return $this->topics;
    }
}
