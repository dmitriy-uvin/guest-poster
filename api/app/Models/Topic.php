<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'platform_id',
        'name'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
