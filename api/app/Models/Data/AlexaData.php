<?php

namespace App\Models\Data;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlexaData extends Model
{
    use HasFactory;

    protected $table = 'alexa_data';

    protected $fillable = [
        'platform_id',
        'rank',
        'country',
        'country_rank'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
