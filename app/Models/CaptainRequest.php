<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptainRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'captain_id',
        'wash_request_id',
        'status'
    ];
}
