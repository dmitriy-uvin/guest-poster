<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemRush extends Model
{
    use HasFactory;

    protected $table = 'semrush';
    public $timestamps = false;

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
