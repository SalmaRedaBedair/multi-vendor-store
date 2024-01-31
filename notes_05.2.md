# local disk & public disk
- local disk => storage/app 
- public disk => storage/app/public
## define file system disk
- in .env

# upload image
```php
protected function uploadImage(Request $request)
{
    if (!$request->hasFile('image')) {
        return;
    }
    $file = $request->file('image');
    $path = $file->store('uploads', 'public');
    // I say store in folder uploads in public disk `storage/app/public`
    return $path;
}
```

# delete Image
```php
// get the path of $old_image from database
// path must be full from after public 
Storage::disk('public')->delete($old_image);
```
- notice that 
```php
Storage::delete($old_image);
// that will delete from default disk which i declared in .env file
```

# php artisan storage:link
- that will go and execute array links in config/filesystems.php
```php
'links' => [
        public_path('storage') => storage_path('app/public'),
        // that will create storage folder in public folder points to app/public
],
```

# upload files into public directly 
- sometimes i have no access to write commands on server
 - so i can't write that `php artisan storage:link`
 - so here it is recommended to make your own disk as shown down
- 
- here it is recommended to create your own disk
- only for simplicity to use syntax similar to of above and don't have to use move and those bad things

```php
'uploads' =>[
    'driver' => 'local',
    'root' => public_path('uploads'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
    'throw' => false,
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