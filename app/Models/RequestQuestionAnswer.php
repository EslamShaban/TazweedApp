<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'question_id',
        'answer'
    ];
}
