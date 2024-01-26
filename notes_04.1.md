# development packages
- i can remove those packages after using it without affect my project 

# component
- any ting start with x-anything is a component
```php
<x-guest-layout>
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

# redirect home
```php
return redirect(RouteServiceProvider::HOME);
// is equal to 
return Redirect::route('dashboard');
```