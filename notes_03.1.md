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

# push & stack
- we use it when i will add style or any thing many times and want all to still in page not to override

# .env 
- if i have any thing include spaces it must be written between double or single qoutetion ('' or "")

# ASSET_URL
- it is defined in .env file 
- if ASSET_URL is not defined laravel will replace it will APP_URL
- base url for asset function 
- it is important because sometimes i put asset files in another server

```php
asset('dist/img/AdminLTELogo.png');
// that is equlal to
// http://127.0.0.1:8000/dist/img/AdminLTELogo.png
```

# cache and .env
- if i make cache for config files, i will not be able to read from .env file
- so it is recommened to read from config file not from .env during working on project 
- any changes in .env after cache will not be noticed
- that config file will be stored in bootstrap/config.php
- that file will contain arrays of data cached
- 