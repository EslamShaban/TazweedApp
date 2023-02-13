<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressTypeTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['type'];
}