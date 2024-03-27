<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'expire_at'
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
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class,'user_id','id')
        ->withDefault();
    }
    public function generateCode()
    {
        $this->timestamps=false;
        $this->code=rand(1000,9999);
        $this->expired_at=now()->addMinute(10);
        $this->save();
    }
    public function resetCode()
    {
        $this->timestamps=false;
        $this->code=null;
        $this->expired_at=null;
        $this->save();
    }
    public function fcmTokens()
{
    return $this->hasMany(DeviceToken::class);
}

    public function routeNotificationForFcm()
    {
        return $this->fcmTokens->pluck('token')->toArray();
    }
}
