<?php

namespace App\Models\Data;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MozData extends Model
{
    use HasFactory;

    protected $table = 'moz_data';

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
