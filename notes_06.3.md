# components in laravel
- it is used to seperate parts of code in view i will use frequently
- to create it 

```
php artisan make:component alert --view

--view => used to till it to make only view file for it not to make class
```

- put code in it like that 

```php
@if (session()->has($type))
    <div class="alert alert-{{ $type }}">
        {{ session($type) }}
    </div>
@endif
```
- call it in view page 

```php
<x-alert type="success" />
```
## props & attributes
-  if i wnat to use $attributes i must use props with it
```php
@props(['type'=>'text','name', 'value'=>''])
<input type="{{ $type ?? 'text' }}"
name="{{ $name }}"
value="{{ old($name, $value) }}"
{{ $attributes }}
@class(['form-control', 'is-invalid' => $errors->has($name)])
/>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
```