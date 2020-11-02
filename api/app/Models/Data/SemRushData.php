<?php

namespace App\Models\Data;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemRushData extends Model
{
    use HasFactory;

    protected $table = 'semrush_data';

    protected $fillable = [
        'platform_id',
        'rank',
        'keyword_num',
        'traffic_costs',
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
