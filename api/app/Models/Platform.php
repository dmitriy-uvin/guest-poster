<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_url',
        'dr',
        'ma',
        'organic_traffic',
        'dofollow_active',
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
        'topics',
        'moz'
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function moz()
    {
        return $this->hasOne(Moz::class);
    }

    public function alexa()
    {
        return $this->hasOne(Alexa::class);
    }

    public function semrush()
    {
        return $this->hasOne(SemRush::class);
    }

    public function majestic()
    {
        return $this->hasOne(Majestic::class);
    }

    public function ahrefs()
    {
        return $this->hasOne(Ahrefs::class);
    }
}
