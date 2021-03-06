<?php

namespace App\Models;

use App\Models\Data\AhrefsData;
use App\Models\Data\AlexaData;
use App\Models\Data\FacebookData;
use App\Models\Data\MajesticData;
use App\Models\Data\MozData;
use App\Models\Data\SemRushData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'protocol',
        'website_url',
        'organic_traffic',
        'dofollow_active',
        'free_home_featured_active',
        'niche_edit_link_active',
        'money_anchor',
        'article_writing_price',
        'niche_edit_link_price',
        'price',
        'deadline',
        'domain_zone',
        'email',
        'comment',
        'contacts',
        'description',
        'article_requirements',
        'where_posted',
        'trust',
        'spam',
        'lrt_power_trust',
        'summary_status',
        'in_trash'
    ];

    protected $with = [
        'topics',
        'moz'
    ];

    protected $attributes = [
        'comment' => null,
        'contacts' => null,
        'in_trash' => false,
        'niche_edit_link_price' => null
    ];

    protected $casts = [
        'in_trash' => 'boolean',
        'dofollow_active' => 'boolean',
        'free_home_featured_active' => 'boolean',
        'niche_edit_link_active' => 'boolean',
        'money_anchor' => 'boolean',
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function moz()
    {
        return $this->hasOne(Moz::class);
    }

    public function mozData()
    {
        return $this->hasMany(MozData::class);
    }

    public function alexa()
    {
        return $this->hasOne(Alexa::class);
    }

    public function alexaData()
    {
        return $this->hasMany(AlexaData::class);
    }


    public function semrush()
    {
        return $this->hasOne(SemRush::class);
    }

    public function semRushData()
    {
        return $this->hasMany(SemRushData::class);
    }

    public function majestic()
    {
        return $this->hasOne(Majestic::class);
    }

    public function majesticData()
    {
        return $this->hasMany(MajesticData::class);
    }

    public function ahrefs()
    {
        return $this->hasOne(Ahrefs::class);
    }

    public function ahrefsData()
    {
        return $this->hasMany(AhrefsData::class);
    }

    public function facebook()
    {
        return $this->hasOne(Facebook::class);
    }

    public function facebookData()
    {
        return $this->hasMany(FacebookData::class);
    }
}
