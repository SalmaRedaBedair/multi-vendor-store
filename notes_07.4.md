# global scope
- used to add global scope over all function of that model
- when i call any function in controller that function booted will be applied first
```php
protected static function booted()
{
    static::addGlobalScope('store', function(Builder $builder){
        $user=Auth::user();
        $builder->where('store_id',$user->store_id);
    });
}
```


