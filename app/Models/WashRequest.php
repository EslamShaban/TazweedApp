<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WashRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'captain_id',
        'location',
        'lat',
        'lng'
    ];

        
    public function asset()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
        
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
