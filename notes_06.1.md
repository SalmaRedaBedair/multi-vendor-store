# unique
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