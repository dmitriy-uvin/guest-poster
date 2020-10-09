<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    use HasFactory;

    protected $table = 'facebook';

    protected $fillable = [
        'platform_id',
        'fb_comments',
        'fb_reac',
        'fb_shares'
    ];

    protected $attributes = [
        'fb_comments' => 0,
        'fb_reac' => 0,
        'fb_shares' => 0
    ];

    public $timestamps = false;

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
