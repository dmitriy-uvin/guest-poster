<?php

namespace App\Models\Data;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhrefsData extends Model
{
    use HasFactory;

    protected $table = 'ahrefs_data';

    protected $fillable = [
        'platform_id',
        'rank',
        'dr',
        'ext_backlinks',
        'refd',
        'dofollow',
    ];

    protected $attributes = [
        'rank' => null,
        'dr' => null,
        'ext_backlinks' => null,
        'refd' => null,
        'dofollow' => null,
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
