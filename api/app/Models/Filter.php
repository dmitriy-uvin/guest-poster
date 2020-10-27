<?php

namespace App\Models;

use App\Models\Constants\FilterTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'type'
    ];

    protected $attributes = [
        'type' => FilterTypes::DEFAULT
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function filterItems()
    {
        return $this->hasMany(FilterItem::class);
    }
}
