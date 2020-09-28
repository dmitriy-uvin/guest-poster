<?php

declare(strict_types=1);

namespace App\Action\Platform;

final class AddPlatformRequest
{
    private string $website_url;
    private int $dr;
    private int $da;
    private int $organicTraffic;
    private bool $do_follow_active;
    private bool $free_home_featured_active;
    private bool $niche_edit_link_active;
    private float $article_writing_price;
    private ?float $niche_edit_link_price;
    private string $contacts;
    private float $price;
    private string $email;
    private string $comment;
    private ?array $topics;
    private int $mozDA;
    private int $mozPA;
    private int $mozLinksIn;
    private float $mozRank;
    private float $alexaRank;
    private string $alexaCountry;
    private float $semrushRank;
    private float $semrushKeywordNum;
    private int $semrushTraffic;
    private int $semrushTrafficCosts;
    private int $majesticExternalBacklinks;
    private int $majesticExternalGov;
    private int $majesticExternalEdu;
    private int $majesticTF;
    private int $majesticCF;
    private ?string $ahrefsStatus;
    private ?float $ahrefsRank;
    private ?float $ahrefsDr;
    private ?int $ahrefsEb;
    private ?int $ahrefsRd;
    private ?int $ahrefsDofollow;
    private ?int $ahrefsIps;

    public function __construct(
        string $website_url,
        int $dr,
        int $da,
        int $organicTraffic,
        bool $do_follow_active,
        bool $free_home_featured_active,
        bool $niche_edit_link_active,
        float $article_writing_price,
        ?float $niche_edit_link_price,
        string $contacts,
        float $price,
        string $email,
        string $comment,
        ?array $topics,
        array $moz,
        array $alexa,
        array $semrush,
        array $majestic,
        ?array $ahrefs
    ) {
        $this->website_url = $website_url;
        $this->dr = $dr;
        $this->da = $da;
        $this->organicTraffic = $organicTraffic;
        $this->do_follow_active = $do_follow_active;
        $this->free_home_featured_active = $free_home_featured_active;
        $this->niche_edit_link_active = $niche_edit_link_active;
        $this->article_writing_price = $article_writing_price;
        $this->niche_edit_link_price = $niche_edit_link_price;
        $this->contacts = $contacts;
        $this->price = $price;
        $this->email = $email;
        $this->comment = $comment;
        $this->topics = $topics;
        $this->mozDA = (int)$moz['da'];
        $this->mozPA = (int)$moz['pa'];
        $this->mozRank = (float)$moz['mozrank'];
        $this->mozLinksIn = (int)$moz['links_in'];
        $this->alexaRank = (float)$alexa['rank'];
        $this->alexaCountry = $alexa['country'];
        $this->semrushRank = (float)$semrush['rank'];
        $this->semrushKeywordNum = (int)$semrush['keyword_num'];
        $this->semrushTraffic = (int)$semrush['traffic'];
        $this->semrushTrafficCosts = (int)$semrush['traffic_costs'];
        $this->majesticExternalBacklinks = (int)$majestic['external_backlinks'];
        $this->majesticExternalGov = (int)$majestic['external_gov'];
        $this->majesticExternalEdu = (int)$majestic['external_edu'];
        $this->majesticTF = (int)$majestic['tf'];
        $this->majesticCF = (int)$majestic['cf'];

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

    public function getDr(): int
    {
        return $this->dr;
    }

    public function getDa(): int
    {
        return $this->da;
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

    public function getNicheEditLinkActive(): bool
    {
        return $this->niche_edit_link_active;
    }

    public function getArticleWritingPrice(): float
    {
        return $this->article_writing_price;
    }

    public function getNicheEditLinkPrice(): ?float
    {
        return $this->niche_edit_link_price;
    }

    public function getContacts(): string
    {
        return $this->contacts;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getComment(): string
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

    public function getMozLinksIn()
    {
        return $this->mozLinksIn;
    }

    public function getMozRank()
    {
        return $this->mozRank;
    }

    public function getAlexaRank()
    {
        return $this->alexaRank;
    }

    public function getAlexaCountry()
    {
        return $this->alexaCountry;
    }

    public function getSemrushRank()
    {
        return $this->semrushRank;
    }

    public function getSemrushKeywordNum()
    {
        return $this->semrushKeywordNum;
    }

    public function getSemrushTraffic()
    {
        return $this->semrushTraffic;
    }

    public function getSemrushTrafficCosts()
    {
        return $this->semrushTrafficCosts;
    }

    public function getMajesticExternalBacklinks()
    {
        return $this->majesticExternalBacklinks;
    }

    public function getMajesticExternalGov()
    {
        return $this->majesticExternalGov;
    }

    public function getMajesticExternalEdu()
    {
        return $this->majesticExternalEdu;
    }

    public function getMajesticTF()
    {
        return $this->majesticTF;
    }

    public function getMajesticCF()
    {
        return $this->majesticCF;
    }

}
