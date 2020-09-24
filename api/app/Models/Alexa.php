<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alexa extends Model
{
    use HasFactory;

    protected $table = 'alexa';
    public $timestamps = false;

    protected $fillable = [
        'platform_id',
        'rank',
        'country'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
