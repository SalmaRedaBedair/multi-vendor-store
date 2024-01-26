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
$product->store() // that will rerurn relation store
$product->store()->first() // will return model, same as first one
```
## for better performance use eager loading
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
- that will take more time, so the above code solve that problem

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

# withDefault
- it will return empty object instead of null
```php
public function parent()
{
     return $this->belongsTo(Category::class,'parent_id','id')
        ->withDefault([
            'name' => '-'
        ]); // it will return empty object instead of null
}
```

# selectRaw
- here i want to write statment to return some thing
- so i should use selectRaw not just select
- select will treat that statment as a column name
```php
selectRaw('(select count(*) from products where category_id=categories_id) as products_count');
// is equal to
select(DB::raw('(select count(*) from products where category_id=categories_id) as products_count'));
```
# select
- i can't use more than one select statment in the same query, so i use array of select
- if i want to use more than one select statment i can use addSelect

```php
$categories = Category::with('parent')
->select('categories.*')
->addSelect(DB::raw('(select count(*) from products where category_id=categories_id) as products_count'));
->filter($request->query())
->orderBy('categories.name')
->paginate();
```

# withcount
- count number of relations with that table

```php
$categories = Category::with('parent')
->withCount('products') // that will add properity with name products_count 
->filter($request->query())
->orderBy('categories.name')
->paginate();
```
## to add condition to withcount like return only active categories
- i use closure function

```php
$categories = Category::with('parent')
->withCount(['products'=> function($query){
    $query->where('status','active')
}]) // that will add properity with name products_count 
->filter($request->query())
->orderBy('categories.name')
->paginate();
```