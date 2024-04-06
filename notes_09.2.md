# middleware
- to make middleware, you must define it in kernel

## middlewares for web and for api
- in routeServiceProvider
```php
Route::middleware('api')
    ->prefix('api')
    ->group(base_path('routes/api.php'));

Route::middleware('web')
    ->group(base_path('routes/web.php'));
```
- those two middleware will be applied directly to all routes inside api or web file

# trim & convert empty string to null
- that cause because of those middlewares

```php
\App\Http\Middleware\TrimStrings::class,
\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
```

# middleware group
- package of middleware that will be applied by default when i call it like that

```php
// in app/http/kernal.php
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];


// in routes/web.php
Route::get('/', [HomeController::class,'index'])->name('home')->middleware('web');
```

# model binding
- that is the middleware which associated for that
- hint: model binding is when i send id it will return instance from that model instead of id
```php
\Illuminate\Routing\Middleware\SubstituteBindings::class
```

# $next($request)
```php
    public function handle(Request $request, Closure $next): Response
    {
        $user=$request->user();
        if(!$user)
        {
            return redirect()->route('login');
        }

        if($user->type=='user')
        {
            abort(403);
        }
        return $next($request); // that mean pass request to next step
        // when i request any page, it will call middlewares before go to controller
        // when it go to middleware it will pass request to next middleware then next middleware then next middleware ... until it reaches controller and pass it to it too
    }
```
## send parameters to middleware
- `middleware_alias: parameters`
```php
    public function handle(Request $request, Closure $next, $type): Response 
    { // $type is a parameter
        $user=$request->user();
        if(!$user)
        {
            return redirect()->route('login');
        }

        if($user->type==$type)
        {
            abort(403);
        }
        return $next($request); 
    }
```
- to pass parameters to the middleware use `:` after middleware alias name
```php
// like that
'type:admin'
```

# web hook & csrf
- when one app send request to my app, like paypal
- paypal can't send csrf, so i must except it from middleware csrf, to not return expired
```php
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'paypal/webhook' // that route is defined in web.php
        // middleware will not be applied to that route
    ];
}

```

# maintenance
- when app in maintenance i write command

```
php artisan down
```
- when i ask website it will say "service unavailable"
- that is because website pass throw middleware called `\App\Http\Middleware\PreventRequestsDuringMaintenance::class` before asking web page

# forceFill
- will update user even if it is not added in $fillable
```php
        if($user)
        {
            $user->forceFill([
                'last_active_at'=>Carbon::now()
            ])->save();
        }
```