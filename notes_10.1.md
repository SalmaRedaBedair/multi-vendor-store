# cookie
```php
protected function getCookieId()
    {
        // Retrieve the value of the 'cart_id' cookie, if it exists
        $cookie_id = Cookie::get('cart_id');

        // Check if the 'cart_id' cookie does not exist
        if (!$cookie_id) {
            // Generate a new UUID using Laravel's Str::uuid() method
            $cookie_id = Str::uuid();

            // Queue a new cookie with the name 'cart_id', the generated UUID as its value,
            // and an expiration time set to 30 days from the current time
            Cookie::queue('cart_id', $cookie_id, Carbon::now()->addDays(30));
        }

        // Return the retrieved or newly generated 'cart_id'
        return $cookie_id;
    }
```

# variable in service container
```php
public function register(): void
    {
        $this->app->bind('cart',function(){
            return new CartModelRepository();
        });
    }
```
- to call it

```php
$repository=App::make('cart');// call variable from service container
```

## another way
```php
public function register(): void
    {
        $this->app->bind(CartRepository::class ,function(){
            return new CartModelRepository();
        });
    }
```

- to call it 
    - we pass it as an argument to function 
    - the functtion will go and search for that class in service provider
    ```php
    public function index(CartRepository $cartRepository)
    {
        $item=$cartRepository->get();

        return view('front.cart',[
            'cart'=>$item
        ]);
    }
    ```

# invoke function 
- it will be called if i call class as a function
```php
class Currency
{
    public function __invoke(...$params){
        return static::format(...$params);
    }
    public static function format($amount, $currency=null)
    {
        $formatter = new NumberFormatter(config('app.local'), NumberFormatter::CURRENCY);
        if($currency==null)
        {
            $currency=config('app.currency','USD');
        }

        return $formatter->formatCurrency($amount, $currency);
    }
}
```

# constructor & middleware
- constructor of controller is called before middleware
- functions of controller is called after middleware

# observer
```php
public function creating(cart $cart): void
    {
        $cart->id=Str::uuid();
        $cart->cookie_id=$cart->getCookieId();
    }
```
- that code will be done while creating 

# query object
```php
public function empty()
    {
        Cart::query()->delete();
        // here i can't call delete like that cart::delete()
        // so i get query object from model and call delete
    }
```

# global scope
- will be applied automatically over all objects of the model

```php
protected static function booted()
    {
        static::observe(CartObserver::class);

        static::addGlobalScope('cookie_id', function(Builder $builder){
            $builder->where('cookie_id',Cart::getCookieId());
        });
    }
```

# static methods
```php
protected static function booted()
    {
        static::observe(CartObserver::class);

        static::addGlobalScope('cookie_id', function(Builder $builder){
            $builder->where('cookie_id',Cart::getCookieId());
        });
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
```
- that booted is static so all inside it must be static so i can't use $cart->getCookieId and user Cart::getCookieId and make getCookieId as a static method

