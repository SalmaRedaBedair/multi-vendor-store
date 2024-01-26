# paginate
- we use it to show limited number of data in every page

```php
public function index()
    {
        $categories = Category::paginate();
        return view('dashboard.categories.index', compact('categories'));
    }
```
- to show it in index

```php
{{ $categories->links() }}
```

- to make it use bootstrap for design

```php
public function boot(): void
    {
        Paginator::useBootstrap();
    }
```
- to keep paramers passed to url while pagination between page

```php
{{ $categories->withQueryString()->links() }}
```
- to add parameters to query string use: appends

```php
{{ $categories->withQueryString()->appends(['search'=>1])->links() }}
```

## i can edit pagination file
- laravel first search for pagination file in resourses if can't find it go to vendor
- to update it i use command `php artisan vendor:publish --tag=laravel-pagination`
- that will add pagination files to resourses
- i can now edit it
