<?php

namespace App\Models\Data;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookData extends Model
{
    use HasFactory;

    protected $table = 'facebook_data';

    protected $fillable = [
        'platform_id',
        'comments',
        'reactions',
        'shares'
    ];

    protected $attributes = [
        'comments' => null,
        'reactions' => null,
        'shares' => null
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
