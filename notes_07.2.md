_do you remember filter i use in the previous video?_
- i can make it using something call scope :"
- notice these notes to know how i will make it ;)

# scopes
## advantages of eloquent
- i can make scopes to use it with quires
- scopes are better to be used
    - if there is any code i will use many times in controller i will not repeat
    - if the code in big the controller will look more simple
    - i achieve the rules of OOP :"
## 1. **static scope**
- have only one status
```php
// in model i define scope

public function scopeActive(Builder $builder)
{
    $builder->whereStatus('active');
}
```
- to call it

```php
$categories=Category::active()->paginate();
```
## 2. **dynamic scope**
- have multiple status, the thing i check is variable, i can pass it
```php
public function scopeStatus(Builder $builder, $status)
{
    $builder->whereStatus($status);
}
```
- to call it
```php
$categories=Category::status('active')->paginate();
```

# self join in laravel
```php
public function index()
    {
    $request = Request();

    // select a.*, b.name as parent_id
    // from categories as a
    // left join categories as b
    // on a.parent_id=b.id
    // order by a.name
    $categories = Category::filter($request->query())
        ->leftjoin('categories as parent','categories.parent_id','parent.id')
        ->select([
            'categories.*',
            'parent.name as parent_name'
        ])
        ->orderBy('name')
        ->paginate(1);

    return view('dashboard.categories.index', compact('categories'));
}
```

