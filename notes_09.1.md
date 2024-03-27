# to replace all asset in vs code
- that will search with regex
```
href="(assets/.+)"
```
```
href="{{asset('$1')}}"
```
# components
- component take the place of inheritance, it is more simple, look more good and organised 
```php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($title=null)
    {
        $this->title=$title?? config('app.name');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.front');
    }
}
```
- layouts.front
```php
// -- code

 {{ $slot }}

// -- code
```
- view i call component in
```php
<x-front-layout>
    the content inside slot
</x-front-layout>
```
- i can make named slot like $breadcrumb
```php
// in layouts.front
{{ $breadcrumb }}
```
- view i call component in
```php
<x-slot name="breadcrumbs">
     // content to show in place of breadcrumb
</x-slot>
```

# accessors
- created inside model
- with it i can call attributes for model as if it was in database but in fact it's not. 
```php
public function get...Attribute()
{

}
```
## example: image_url
```php
public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
```
```php
// call it
$model->image_url
```
# customizing route key in specific route
- if i want to find post by slug not id, and send slug in url
```php
Route::get('/posts/{post:slug}', function (Post $post) {
    return view('posts.show', compact('post'));
})->name('posts.show');
```
