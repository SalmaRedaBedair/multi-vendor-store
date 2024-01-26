# service container & middleware
- service container is applied before middleware

# collect
```php
$this->items=collect([]);
```
- convert array to obejct

- that have method sum which will sum all values in that element

```php
$this->get('quantity');
// that get is defined to return collection
```
- read that for more details and understand collections more good [link](https://laravel.com/docs/10.x/collections)
- collection is very important because queries in database return collection
