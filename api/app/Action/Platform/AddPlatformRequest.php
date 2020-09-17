<?php

declare(strict_types=1);

namespace App\Action\Platform;

final class AddPlatformRequest
{
    private string $website_url;
    private int $dr;
    private int $ma;
    private int $organic_traffic;
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

    public function __construct(
        string $website_url,
        int $dr,
        int $ma,
        int $organic_traffic,
        bool $do_follow,
        bool $free_home_featured,
        bool $niche_edit_link,
        float $article_writing_price,
        ?float $niche_edit_link_price,
        string $contacts,
        float $price,
        string $email,
        string $comment,
        ?array $topics
    ) {
        $this->website_url = $website_url;
        $this->dr = $dr;
        $this->ma = $ma;
        $this->organic_traffic = $organic_traffic;
        $this->do_follow_active = $do_follow;
        $this->free_home_featured_active = $free_home_featured;
        $this->niche_edit_link_active = $niche_edit_link;
        $this->article_writing_price = $article_writing_price;
        $this->niche_edit_link_price = $niche_edit_link_price;
        $this->contacts = $contacts;
        $this->price = $price;
        $this->email = $email;
        $this->comment = $comment;
        $this->topics = $topics;
    }

    public function getWebsiteUrl(): string
    {
        return $this->website_url;
    }

    public function getDr(): int
    {
        return $this->dr;
    }

    public function getMa(): int
    {
        return $this->ma;
    }

    public function getOrganicTraffic(): int
    {
        return $this->organic_traffic;
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
}
