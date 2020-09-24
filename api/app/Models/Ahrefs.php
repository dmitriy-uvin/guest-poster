<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ahrefs extends Model
{
    use HasFactory;

    protected $table = 'ahrefs';
    public $timestamps = false;

    protected $fillable = [
        'platfrom_id',
        'status',
        'rank',
        'dr',
        'eb',
        'rd',
        'dofollow',
        'ips'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
