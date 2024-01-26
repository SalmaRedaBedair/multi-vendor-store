# routes
## any
- route will be requested with any method

```php
Route::any('/dashboard',[DashboardController::class,'index']);
```
## match
- take array of methods
- define what types of methods that url will be requested by

```php
Route::match(['get','post'],'/dashboard',[DashboardController::class,'index']);
```

# compact

```php
return view('dashboard', compact('name'));
// is equal to 
return view('dashboard', ['name'=>'salma reda']);
// is equal to 
return view('dashboard')->with(['name'=>'salma reda'])
// is equal to 
return View::make('dashboard',['name'=>'salma'])
// is equal to 
return response()->view('dashboard',['name'=>'salma'])
// is equal to 
return Response::view('dashboard',['name'=>'salma'])
```