<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterItem extends Model
{
    use HasFactory;

    protected $table = 'filter_items';

    protected $fillable = [
        'name',
        'property',
        'column_name',
        'from',
        'to',
        'value',
        'items',
        'type'
    ];

    protected $casts = [
        'items' => 'array'
    ];

    protected $attributes = [
        'from' => null,
        'to' => null,
        'value' => null,
        'items' => null,
        'column_name' => null
    ];

    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }
}
