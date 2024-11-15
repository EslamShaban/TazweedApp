<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProductTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'desc', 'features'];

        
    protected function features(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
    
}
