<?php

namespace App\Facade;

use App\Repositories\Cart\CartRepository;
use Facade;

class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CartRepository::class;
    }
}
