<?php

declare(strict_types=1);

namespace App\Action\Platform;

final class AddPlatformRequest
{
    private string $website_url;
    private int $organicTraffic;
    private bool $do_follow_active;
    private bool $free_home_featured_active;
    private bool $niche_edit_link_active;
    private float $article_writing_price;
    private ?float $niche_edit_link_price;
    private ?string $contacts;
    private float $price;
    private string $description;
    private string $article_requirements;
    private int $deadLine;
    private string $wherePosted;
    private string $email;
    private ?string $comment;
    private ?array $topics;
    private int $mozDA;
    private int $mozPA;
    private int $mozLinksIn;
    private int $mozEquity;
    private float $mozRank;
    private float $alexaRank;
    private string $alexaCountry;
    private int $alexaCountryRank;
    private float $semrushRank;
    private float $semrushKeywordNum;
    private int $semrushTrafficCosts;
    private int $fbComments;
    private int $fbReac;
    private int $fbShares;
    private int $majesticExternalBacklinks;
    private int $majesticExternalGov;
    private int $majesticExternalEdu;
    private int $majesticTF;
    private int $majesticCF;
    private int $majesticRefD;
    private int $majesticRefD_EDU;
    private int $majesticRefD_GOV;
    private ?string $ahrefsStatus;
    private ?float $ahrefsRank;
    private ?float $ahrefsDr;
    private ?int $ahrefsEb;
    private ?int $ahrefsRd;
    private ?int $ahrefsDofollow;
    private ?int $ahrefsIps;

    public function __construct(
        string $website_url,
        int $organicTraffic,
        bool $do_follow_active,
        bool $free_home_featured_active,
        bool $niche_edit_link_active,
        float $article_writing_price,
        ?float $niche_edit_link_price,
        ?string $contacts,
        float $price,
        string $email,
        ?string $comment,
        ?array $topics,
        array $moz,
        array $alexa,
        array $semrush,
        array $majestic,
        ?array $ahrefs,
        string $description,
        string $article_requirements,
        int $deadLine,
        string $where_posted,
        array $fb
    ) {
        $this->website_url = $website_url;
        $this->organicTraffic = $organicTraffic;
        $this->do_follow_active = $do_follow_active;
        $this->free_home_featured_active = $free_home_featured_active;
        $this->niche_edit_link_active = $niche_edit_link_active;
        $this->article_writing_price = $article_writing_price;
        $this->niche_edit_link_price = $niche_edit_link_price;
        $this->contacts = $contacts;
        $this->price = $price;
        $this->description = $description;
        $this->article_requirements = $article_requirements;
        $this->deadLine = $deadLine;
        $this->wherePosted = $where_posted;
        $this->email = $email;
        $this->comment = $comment;
        $this->topics = $topics;
        $this->mozDA = (int)$moz['da'];
        $this->mozPA = (int)$moz['pa'];
        $this->mozRank = (float)$moz['mozrank'];
        $this->mozLinksIn = (int)$moz['links_in'];
        $this->mozEquity = (int)$moz['equity'];
        $this->alexaRank = (float)$alexa['rank'];
        $this->alexaCountry = $alexa['country'];
        $this->alexaCountryRank = (int)$alexa['country_rank'];
        $this->semrushRank = (float)$semrush['rank'];
        $this->semrushKeywordNum = (int)$semrush['keyword_num'];
        $this->semrushTrafficCosts = (int)$semrush['traffic_costs'];
        $this->fbComments = (int)$fb['fb_comments'];
        $this->fbReac = (int)$fb['fb_reac'];
        $this->fbShares = (int)$fb['fb_shares'];
        $this->majesticExternalBacklinks = (int)$majestic['external_backlinks'];
        $this->majesticExternalGov = (int)$majestic['external_gov'];
        $this->majesticExternalEdu = (int)$majestic['external_edu'];
        $this->majesticTF = (int)$majestic['tf'];
        $this->majesticCF = (int)$majestic['cf'];
        $this->majesticRefD = (int)$majestic['refd'];
        $this->majesticRefD_EDU = (int)$majestic['refd_edu'];
        $this->majesticRefD_GOV = (int)$majestic['refd_gov'];

        // TODO: Must be tested and fixed if needed
        $this->ahrefsStatus = $ahrefs ? $ahrefs['status'] : null;
        $this->ahrefsRank = $ahrefs ? (float)$ahrefs['rank'] : null;
        $this->ahrefsDr = $ahrefs ? (float)$ahrefs['dr'] : null;
        $this->ahrefsEb = $ahrefs ? (int)$ahrefs['eb'] : null;
        $this->ahrefsRd = $ahrefs ? (int)$ahrefs['rd'] : null;
        $this->ahrefsDofollow = $ahrefs ? (int)$ahrefs['dofollow'] : null;
        $this->ahrefsIps = $ahrefs ? (int)$ahrefs['ips'] : null;
    }

    public function getAhrefsStatus()
    {
        return $this->ahrefsStatus;
    }

    public function getAhrefsRank(): ?float
    {
        return $this->ahrefsRank;
    }

    public function getAhrefsDr(): ?float
    {
        return $this->ahrefsDr;
    }

    public function getAhrefsEb(): ?int
    {
        return $this->ahrefsEb;
    }

    public function getAhrefsRd(): ?int
    {
        return $this->ahrefsRd;
    }

    public function getAhrefsDofollow(): ?int
    {
        return $this->ahrefsDofollow;
    }

    public function getAhrefsIps(): ?int
    {
        return $this->ahrefsIps;
    }

    public function getWebsiteUrl(): string
    {
        return $this->website_url;
    }

    public function getOrganicTraffic(): int
    {
        return $this->organicTraffic;
    }

    public function getDoFollowActive(): bool
    {
        return $this->do_follow_active;
    }

    public function getFreeHomeFeaturedActive(): bool
    {
        return $this->free_home_featured_active;
    }

    public function getWherePosted(): string
    {
        return $this->wherePosted;
    }

    public function getNicheEditLinkActive(): bool
    {
        return $this->niche_edit_link_active;
    }

    public function getArticleWritingPrice(): float
    {
        return $this->article_writing_price;
    }

    public function getArticleRequirements(): string
    {
        return $this->article_requirements;
    }

    public function getNicheEditLinkPrice(): ?float
    {
        return $this->niche_edit_link_price;
    }

    public function getContacts(): ?string
    {
        return $this->contacts;
    }

    public function getDeadLine(): int
    {
        return $this->deadLine;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getTopics(): ?array
    {
        return $this->topics;
    }

    public function getMozDA(): int
    {
        return $this->mozDA;
    }

    public function getMozPA(): int
    {
        return $this->mozPA;
    }

    public function getMozLinksIn(): int
    {
        return $this->mozLinksIn;
    }

    public function getMozRank(): float
    {
        return $this->mozRank;
    }

    public function getMozEquity(): int
    {
        return $this->mozEquity;
    }

    public function getAlexaRank(): float
    {
        return $this->alexaRank;
    }

    public function getAlexaCountry(): string
    {
        return $this->alexaCountry;
    }

    public function getAlexaCountryRank(): int
    {
        return $this->alexaCountryRank;
    }

    public function getSemrushRank(): float
    {
        return $this->semrushRank;
    }

    public function getSemrushKeywordNum(): float
    {
        return $this->semrushKeywordNum;
    }

    public function getSemrushTrafficCosts(): int
    {
        return $this->semrushTrafficCosts;
    }

    public function getFbComments(): int
    {
        return $this->fbComments;
    }

    public function getFbReac(): int
    {
        return $this->fbReac;
    }

    public function getFbShares(): int
    {
        return $this->fbShares;
    }

    public function getMajesticExternalBacklinks(): int
    {
        return $this->majesticExternalBacklinks;
    }

    public function getMajesticExternalGov(): int
    {
        return $this->majesticExternalGov;
    }

    public function getMajesticExternalEdu(): int
    {
        return $this->majesticExternalEdu;
    }

    public function getMajesticTF(): int
    {
        return $this->majesticTF;
    }

    public function getMajesticCF(): int
    {
        return $this->majesticCF;
    }

    public function getMajesticRefD(): int
    {
        return $this->majesticRefD;
    }

    public function getMajesticRefDEDU(): int
    {
        return $this->majesticRefD_EDU;
    }

    public function getMajesticRefDGOV(): int
    {
        return $this->majesticRefD_GOV;
    }
}
