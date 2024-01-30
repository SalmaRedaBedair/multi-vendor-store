# development packages
- i can remove those packages after using it without affect my project
- if i need it only for development i add --dev at the end of the command to not add it while production

# important note
- `php artisan breeze:install`
- that will make new web.php file, any code i write in it will be deleted

# delete packages
- i can delete development packages after install it using command `composer remove 'package name' --dev'`
- that will not affect my project 

# npm run
- compile js and css folders in the resources file and put them in public folder
## npm run prod
- make those files zipped, i can't understand anything on them, can't update their content
## npm run dev
- can understand files, can update them 

# laravel breeze 
- use tailwind instead of bootstrap

# component
- any tag start with <x-anything /> is a component
- component mean that tag is replaced by a file
```php
<x-guest-layout />
```

# attributes in blade system
```php
<x-label for="email" :erros="$errors">
// is equal to
<x-label for="email" erros="{{ $errors }}">
```
# auth
```php
@if(Auth::check())=@auth
```

# helper function & facade
- every helper function have facade

# csrf
- must use route with any method rather than get
- it is random string stored in the session of the server
- when i use @csrf that token will be added to form
- laravel check if that token in the form @csrf is the same as in the session of the server, if they are the same then ok, user who sent that form

```php
@csrf
// is equal to
<input type="hidden" name="_token" value="TkL2fylG2k8ag4O5b1zK9XSAEsrKYTIv59lrdKWE">
// is equal to
{{ csrf_field() }}
```

# redirect home
```php
return redirect(RouteServiceProvider::HOME); // open RouteServiceProvider class, you will find HOME const in it
// is equal to 
return Redirect::route('dashboard');
```

# email verification
1. use middleware 'verify'
2. use interface MustVerifyEmail in User model
3. update .env file to sent mail to place you want, ex if sent to log file `MAIL_MAILER=log`