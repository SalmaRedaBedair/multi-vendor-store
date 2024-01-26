<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;
    public $incrementing=false;
    protected $fillable=['cookie_id','user_id','product_id','quantity','options'];

    protected static function booted()
    {
        static::observe(CartObserver::class);

        static::addGlobalScope('cookie_id', function(Builder $builder){
            $builder->where('cookie_id',Cart::getCookieId());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class)
        ->withDefault([
            'name'=>'Anonymous'
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public static function getCookieId()
    {
        // Retrieve the value of the 'cart_id' cookie, if it exists
        $cookie_id = Cookie::get('cart_id');

        // Check if the 'cart_id' cookie does not exist
        if (!$cookie_id) {
            // Generate a new UUID using Laravel's Str::uuid() method
            $cookie_id = Str::uuid();

            // Queue a new cookie with the name 'cart_id', the generated UUID as its value,
            // and an expiration time set to 30 days from the current time
            Cookie::queue('cart_id', 30*24*60);
        }

        // Return the retrieved or newly generated 'cart_id'
        return $cookie_id;
    }
}
