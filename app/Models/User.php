<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements JWTSubject
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'password',
        'phone',
        'account_type',
        'lat',
        'lng',
        'status',
        'available',
        'city_id',
        'fcm'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $appends = ['image_path'];


    public function getImagePathAttribute(){
         
        return asset(($this->asset->url ?? 'assets/images/default.png'));
        
    }

    public function scopeAvailableCaptains($q) 
    {
        return $q->where('account_type', 'captain')->where('status', 1)->where('available', 1);
    }

    public function asset()
    {
        return $this->morphOne(Asset::class, 'assetable');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }


    public function shipping_addresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }

    public function captain_wash_requests()
    {
        return $this->hasMany(WashRequest::class, 'captain_id');
    }

    //captain avg_rate
    public function avg_rate()
    {
       return DB::table('wash_requests')
                ->join('reviews', 'wash_requests.id', '=', 'reviews.reviewable_id')
                ->where('wash_requests.captain_id', '=', $this->id)
                ->where('reviews.reviewable_type', '=', 'App\Models\WashRequest')
                ->select('reviews.rate')
                ->pluck('rate')
                ->avg();
    }
}

