# relations between models
```php
// in model
 public function Store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
```
```php
$product->store // that will return model Store
$product->store() // that will return relation store
$product->store()->first() // will return model, same as first one
```
# [Laravel N+1 Query Detector](https://github.com/beyondcode/laravel-query-detector)
- that package will give you advices to use eager loading in case of n+1 problem
- improve performance

## for better performance use eager loading (use with)
```php
$contacts = Contact::with('phoneNumbers')->get();
```
- instead of 
```php
$contacts = Contact::all();
foreach ($contacts as $contact) {
    foreach ($contact->phone_numbers as $phone_number) {
        echo $phone_number->number;
    }
}
```
### models take consume more memory
- that will load all relations between models before return 
```php
 public function index()
{
    $products=Product::with(['category','store'])->paginate(); // 3 select from database 
    // select * from products
    // select * from categories where id in (..)
    // select * from stores where id in (..)
    return view('dashboard.products.index', compact('products'));
}
```
- that will take more time, there will be query in every loop

```php
@foreach ($products as $product) // 2*n select from data base
<tr>
    <td>
        <img src="{{ asset('storage/' . $product->image) }}" alt="" height="60">
    </td>
    <td>{{ $product->id }}</td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->category->name }}</td> // that is select statment 
    <td>{{ $product->store->name }}</td>   // that is select statment 
    <td>{{ $product->status }}</td>
    <td>{{ $product->created_at }}</td>
    <td>
</tr>    
@endforeach
```
## joins 
- we may use joins for better performance, it is better that eager loading

## now important question when to use eager loading and when to use joins, understand diffrent between them well

### `withDefault`
- Instead of returning `null`, `withDefault` will return an empty object.
- You can specify default values to overwrite.

```php
public function parent()
{
    return $this->belongsTo(Category::class, 'parent_id', 'id')
        ->withDefault([
            'name' => '-'
        ]);
}
```

### `selectRaw`
- Use `selectRaw` when you need to write a custom SQL statement to return specific values.
- The statement executes as written and returns column names as specified aliases for use as property names.
```php
selectRaw('(select count(*) from products where category_id=categories_id) as products_count');
// is equal to
select(DB::raw('(select count(*) from products where category_id=categories_id) as products_count'));
```

```php
$selectRawQuery = '(select count(*) from products where category_id = categories_id) as products_count';
$categories = Category::with('parent')
    ->selectRaw($selectRawQuery)
    ->filter($request->query())
    ->orderBy('categories.name')
    ->paginate();
```

### `select`
- Multiple `select` statements can't be used in the same query, so use an array of `select`.
- If more than one `select` is needed, `addSelect` should be used.

```php
$categories = Category::with('parent')
    ->select('categories.*')
    ->addSelect(DB::raw('(select count(*) from products where category_id = categories_id) as products_count'))
    ->filter($request->query())
    ->orderBy('categories.name')
    ->paginate();
```

### `withCount`
- Counts the number of relations with another table, providing the number of rows from the related table that have a connection with the current model.

```php
$categories = Category::with('parent')
    ->withCount('products') // Adds a property named 'products_count'.
    ->filter($request->query())
    ->orderBy('categories.name')
    ->paginate();
```

### Adding Conditions to `withCount`
- You can add conditions to `withCount`, such as returning only active categories, by passing an array of relations as keys and closure functions with the desired conditions.

```php
$categories = Category::with('parent')
    ->withCount(['products' => function ($query) {
        $query->where('status', 'active');
    }])
    ->filter($request->query())
    ->orderBy('categories.name')
    ->paginate();
```
