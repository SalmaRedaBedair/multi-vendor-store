# scopes
- when i try to return query with only active status

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
## dynamic scope
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