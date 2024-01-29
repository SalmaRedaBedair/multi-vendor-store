# show
- that will place a place like yeild and show it
- i use it when there is part of code will be found in all childs so i put it in parent
```php
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Home</a></li>
@show
```
# yeild take default values
```php
@yield('title','Page Title')
```

# i can pass values from one view file to the other
```php
@include('layouts.partials.nav', ['active'=>'dashboard'])
```

# push & stack
- we use it when i will add style or any thing many times and want all to still in page not to override

# .env 
- env mean enviornment variable
- if i have any thing include spaces it must be written between double or single qoutetion ('' or "")

# ASSET_URL
- it is defined in .env file 
- if ASSET_URL is not defined laravel will replace it will APP_URL
- ASSET_URL is the base url for asset function 
- it is important because sometimes i put asset files in another server

```php
asset('dist/img/AdminLTELogo.png');
// that is equlal to
// that asset function will take asset_url as its domain, if asset_url not exist it will take app_url
// http://127.0.0.1:8000/dist/img/AdminLTELogo.png
```

# php artisan config:cache
- that will take all config files and put there data in arrays in bootstrap/cache/config.php
- we make that to run them only one time, so we will improve performance
- that command must be done during production only beacause any updates i make in that files after cache will not be appear
- to clear cache `php artisan config:clear`

# cache and .env
- if i make cache for config files, i will not be able to read from .env file
- so it is recommened to read from config file not from .env during working on project 
- any changes in .env after cache will not be noticed

```php
<span>{{env('APP_NAME')}}</span> // xxxxx will not work after cache

// to solve it i should read form config
<span>{{config('app.name')}}</span> 

// for more clarification 
// in cofig/app.php
'name' => env('APP_NAME', 'Laravel'), // config take configration form .env file so that i can use in my app safely after caching
```