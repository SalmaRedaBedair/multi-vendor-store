# validations
- there is two types of validation i may use
  - request
  - database
## database based validation
- if you want to output custom messages for the users, like that 
```php
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

try {
    // Your database query that may throw an exception
    DB::table('your_table')->insert([
        'column_name' => $value,
    ]);
} catch (QueryException $e) {
    // Catch the exception and handle it
    $errorCode = $e->errorInfo[1]; // Get the error code

    // Check for specific error codes and provide custom error messages
    if ($errorCode == 1062) { // Example: MySQL duplicate entry error code
        return response()->json(['error' => 'This record already exists.'], 422); // Provide a user-friendly message
    } else {
        // Handle other types of errors gracefully
        return response()->json(['error' => 'An error occurred. Please try again later.'], 500);
    }
}

```
# unique
- it take 3 parameters: the table which is that field unique, the unique column in that table, the id of the field to ignore 
```php
public static function rules($id=0)
{
    return [
        'name' => "required|string|min:3|max:255|unique:categories,name,$id",
        // that $id will be id of the current row
        // i pass it to tell him that unique is not applied for that record to work while update
        'parent_id' => 'nullable|int|exists:categories,id',
        'image' => 'image|max:1048576|dimensions:min_width=100,min_height=100',
        'status' => 'in:active,archived',
    ];
}
```
- `unique:categories,name,$id` is equal to

```php
Rule::unique('categories','name')->ignore($id)
```
- in request i pass id 

```php
public function rules(): array
{
    $id= $this->route('category'); // /{category} it is written as that in route definition write `php artisan r:l` to show it
    return Category::rules($id);
}
```

# request
- validation will be done automatically i don't have to call it
```php
// in request
public function rules(): array
{
    $id= $this->route('category');
    return Category::rules();
}

// in model
public static function rules($id=0)
{
    return [
        'name' => "required|string|min:3|max:255|unique:categories,name,$id",
        // that $id will be id of the current row
        // i pass it to tell him that unique is not applied for that record to work while update
        'parent_id' => 'nullable|int|exists:categories,id',
        'image' => 'image|max:1048576|dimensions:min_width=100,min_height=100',
        'status' => 'in:active,archived',
    ];
}
```

# show errors
## i my show them as a package above the form
```php
<ul>
@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
```
## show them for every filed
```php
// example for filed name
@if($errors->has('name')) 
<div class = "text-danger">
$errors->first('name')
</div>
@endif
```
- that is equal to 
```php
@error('name') // is equal to `@if($errors->has('name'))`
<div class = "text-danger">
$message // is equal to `$errors->first('name')`, that message variable only contain the first error message
</div>
@enderror
```

# @class
```php
@class([
    'form-control',
    'is-invalid' => $errors->has($name) // if there is error is-invalid will add to class list
    // that replace @error('name') is-invalid @enderror inside the class
])
```
- that equal to 
```php
<div class="form-control @error('name') is-invalid @enderror"></div>
```

# old function 
- take two arguments
- first field name, second the default value of that field if there is no old value
- old value appear in case of there is error validations
- default value is important to edit and update to the form
```php
old('name')?? $category->name
// is equal to

old('name', $category->name) 
```

# return data from validation
```php
$data = $request->validated()
```
- that will return only checked data
- if there is any data i don't add in in request validation array, so i can't use that because i may miss some data 

# Request
- if i use Request class i have not to add 
```php
$request->validated();
```
- validation will be done automatically
## change message of specific rule over all application
- from lang/validation.php