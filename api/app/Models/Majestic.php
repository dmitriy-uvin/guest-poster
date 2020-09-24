<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Majestic extends Model
{
    use HasFactory;

    protected $table = 'majestic';
    public $timestamps = false;

    protected $fillable = [
        'platform_id',
        'external_backlinks',
        'external_gov',
        'external_edu',
        'tf',
        'cf',
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
