<?php

namespace App\Observers;

use App\Models\cart;
use illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the cart "created" event.
     */
    public function creating(cart $cart): void
    {
        $cart->id=Str::uuid();
        $cart->cookie_id=$cart->getCookieId();
    }

    /**
     * Handle the cart "updated" event.
     */
    public function updated(cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "deleted" event.
     */
    public function deleted(cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "restored" event.
     */
    public function restored(cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "force deleted" event.
     */
    public function forceDeleted(cart $cart): void
    {
        //
    }
}
