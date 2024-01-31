# take data from request
```php
$request->input('name'); // give me data even if it is with post or get
                         // from the form or url
$request->post('name');  // give me data with method post only
$request->query('name'); // give me data from url
$request->get('name');  // give me data from post or get
                        // from form or url
$request->name; // get or post
$request['name']; // get or post
```

## request->all()
- return with post and get
- if in route i define method as get and user $request->all() 
 - it will return data with get
 - all data because form will add its data to url
- if i define it as post 
 - request->all() will return only data with post
 - return only data in the form
### summary
- If the route method is GET, $request->all() will include GET data.
- If the route method is POST, $request->all() will only include POST data.

# slug
- URL-friendly version of a string 
- Slugs are created by converting the string to lowercase, replacing spaces with hyphens, and removing special characters that are not URL-friendly.

```php
use Illuminate\Support\Str;

$title = "10 Tips for Better Productivity";
$slug = Str::slug($title); // Generates "10-tips-for-better-productivity"
```

# redirect->with()
- send message stored in session to the next request 
- after that it will be deleted automatically with js, no laravel code here

# route group
```php
Route::group([
    'middleware' => ['auth','auth.type:super-admin,admin'],
    'as' => 'dashboard.',
    'prefix' => 'admin/dashboard',
], function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
});

Route::middleware('auth','auth.type:super-admin,admin')
->name('dashboard.')
->prefix('admin/dashboard')
->group(function({
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
}));
```
- these two definitions are equal
- Route::group 
 - static function
 - that Route facade is for object from router class
 - that group will call function group in router class
- ->group() 
 - call function group in RouterRegister class
 - that router register call group() in router class and send to it array of attributes and callback function that contain routes 
 - that array of attributes was filled by previous methods in chaining like(name(), prefix(), middleware())
- both of them at the end use group() method in router class