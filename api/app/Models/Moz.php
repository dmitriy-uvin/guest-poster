<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moz extends Model
{
    use HasFactory;

    protected $table = 'moz';
    public $timestamps = false;

    protected $fillable = [
        'platform_id',
        'pa',
        'da',
        'rank',
        'links_in',
        'equity'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
