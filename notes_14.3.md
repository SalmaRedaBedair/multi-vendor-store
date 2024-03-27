# laravel fortify
- backend authentication 
## guard
- namespace of the authentication system

# sanctum
## guard and middleware 
- they are used when use web only, if i make api for web app i will not use it 
## protected property in model
- here i add all sensitive data i want to hide from user while return 
```php
class User extends Authenticatable implements MustVerifyEmail
{
    protected $hidden = [
        'password',
        'remember_token',
    ];
```

## work as guest and auth with sanctum
```php
Route::middleware('auth:sanctum')->get('/user', function () {
    return \Illuminate\Support\Facades\Auth::guard('sanctum')->user();
});

Route::post('auth/access-tokens',[\App\Http\Controllers\Api\AccessTokensController::class,'store'])
    ->middleware('guest:sanctum');

Route::delete('auth/access-tokens/{token?}',[\App\Http\Controllers\Api\AccessTokensController::class,'destroy'])
    ->middleware('Auth:sanctum');
```
## tokenCan
- check if i add that permission in abilities of the user token or not
```php
$token=$user->createToken($device_name, $request->post('abilities'));
```
```php
if(!$user->tokenCan('products.create')){

}
```

# api token
- used to make api more secure, no one can access my api 
- sometimes may be the user is authenticated in post man from another project and he can enter my project and use it, which is not secure
- so we make api key to make only my users can use my api
- store that api key in .env and config.app.api_token
- that api token will be passed in the header of request and i will check if it match with my api_key in config
- create middleware
```
php artisan make:middleware CheckApiToken
```
```php
    public function handle(Request $request, Closure $next): Response
    {
        $api_token=$request->header('x-api-key');
        if($api_token !== config('app.api_token'))
        {
            return \Illuminate\Support\Facades\Response::json([
                'message'=>'Invalid Api Token'
            ],400);
        }
        return $next($request);
    }
```