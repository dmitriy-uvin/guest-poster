<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = [
        'website_url',
        'dr',
        'ma',
        'organic_traffic',
        'do_follow_active',
        'free_home_featured_active',
        'niche_edit_link_active',
        'article_writing_price',
        'niche_edit_link_price',
        'contacts',
        'price',
        'email',
        'comment',
    ];

    protected $with = [
        'topics'
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
