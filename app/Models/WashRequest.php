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

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function captain()
    {
        return $this->belongsTo(User::class, 'captain_id');
    }

    public function images($status)
    {
        $assets = $this->asset()->where('info->status', $status)->get();
        $images = array();
        foreach ($assets as $key => $asset) {
            $images[] = asset($asset->url);
        }

        return $images;
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'request_question_answers', 'request_id', 'question_id')->withPivot('answer');
    }

    public function question_answer($question_id)
    {
        $question = $this->questions()->where('question_id', $question_id)->first();
        return $question ? $question->pivot->answer : __('admin.not_found');
    }

    public function total_price()
    {
        $setting = Setting::first();
        $service_price = $setting->service_price ;
        $tax = $setting->tax ;
        $tip = $this->tip;

        return $service_price + $tax + $tip;

    }
}
