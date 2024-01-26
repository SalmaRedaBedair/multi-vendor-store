# custom validation rule
- we use it to make our own rule for valiation like forbidden some keywords
- run command

```
php artisan make:Rule Filter
```
- inside `app/rules/filter`
```php
public function validate(string $attribute, mixed $value, Closure $fail): void
{
    if (in_array(strtolower($value), $this->forbidden)) {
        $fail("This value for $attribute is forbidden");
    }
}

// to call it i call object Filter 
new Filter($forbidden)
```
## make rule like that `filter:php,laravel,html,css`
```php
Validator::extend('filter', function ($attribute, $value,$params) {
    return !(in_array(strtolower($value),$params));
}, "That value is prohibited!");
```
## i can make it using closure too
```php
// inside rule array
function ($attribute, $value, $fail){
    if (in_array(strtolower($value), ['laravel','html','php'])) {
        $fail("This value for $attribute is forbidden");
    }
}
```
