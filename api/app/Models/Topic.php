<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alias'
    ];

    public $timestamps = false;

    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }
}
