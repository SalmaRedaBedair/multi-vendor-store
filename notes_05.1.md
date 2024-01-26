# find
```php
$category=Category::find($id);
dd($category);
```
![](./images/find.jpg)
- if exsists true, find will return true, vice versa

# findorfail
- i tell him if you can't find object give me error 404 page

```php
$category=Category::find($id);
if(!$category)
{
    abort(404);
}

// is equal to 
$category=Category::findorfail($id);
```
# destroy
```php
Category::destroy($id);
// is equal to 
$category=Category::findorfail($id);
$category->delete();
```

# group where using query bulider
```php
// SELECT * from categories whrere `id` <> $id and (parent_id is null or parent_id <> $parent_id)
// to write that () i must use grouping over where
$parents=Category::where('id','<>',$id)
->where(function($query) use($id){ // we use that use to can use $id over closure function, i can't write that function($query,$id)
    $query->wherenull('parent_id')
    ->orWhere('parent_id','<>',$id);
})
->get();
```

# php artisan storage:link
- that will go and excute array links in config/filesystems.php

```php
'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
```

# advices for clean code
- code in if must be smaller, like that 

```php
public function uploadImage(Request $request)
{
    if (!$request->hasFile('image')) {
        return;
    }
    $file = $request->file('image');
    $path = $file->store('uploads', 'public');
    $data['image'] = $path;
}
```