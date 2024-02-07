# paginate
- we use it to show limited number of data in every page

```php
public function index()
    {
        $categories = Category::paginate();
        // or $categories = Category::simplePaginate();
        // use simplePaginate if i only want to show previous and next to visit pages
        return view('dashboard.categories.index', compact('categories'));
    }
```
- to show links of next or previous pages in index

```php
{{ $categories->links() }}
```

- to make pagination use bootstrap for design, laravel by default use tailwind

```php
public function boot(): void
    {
        Paginator::useBootstrap();
    }
```

# filter data
## query builder
- every model in laravel has its own query builder to get it i say
```php
$query=Post::query()

// now i can use $query and get data as i want like that

$query->where('id', $id)->get;
```
- query builder is better to be used if i will make checks over my code using if statements like in filter, notice that code
```php
$query= Category::query();
if($name=$request->query('name')) // that query is for parameters i pass in url, it is different form the above query
{
    $query->where('name','like',"%{$name}%");
}
if(status=$request->query('status'))
{
    $query->where('status',$status);
}
$categories=$query->get();
```
- old('','') => that save data if method post only if method get i must send it using request('name')
## to keep parameters passed to url while pagination between page, to keep filter

```php
{{ $categories->withQueryString()->links() }}
```
## to add parameters to query string use: appends

```php
{{ $categories->withQueryString()->appends(['search'=>1])->links() }}
```

## i can edit pagination file
- laravel first search for pagination file in resources if can't find it go to vendor
- to update it i use command `php artisan vendor:publish --tag=laravel-pagination`
- that will add pagination files to  resources
- i can now edit it, to add my own style for pagination
