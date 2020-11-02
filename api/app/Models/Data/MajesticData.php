<?php

namespace App\Models\Data;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajesticData extends Model
{
    use HasFactory;

    protected $table = 'majestic_data';

    protected $fillable = [
        'platform_id',
        'external_backlinks',
        'external_gov',
        'external_edu',
        'tf',
        'cf',
        'refd',
        'refd_edu',
        'refd_gov',
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
