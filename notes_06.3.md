# make component
- create files of the component in component folder 
## to use them
##  <component-name /> 
- use that when you won't to add any  thing to it 
## <component-name></component-name>
- when you want to add any thing inside it

# components in laravel
- it is used to separate parts of code in view i will use frequently
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

# now i will explain component in details starting form the block of code i convert to component 
## that was the code i use in every file i want to create input in
```php
<input type="text"
       name="name"
       value="{{ old('name', $category->id) }}"
        @class([
            'form-control',
            'is-invalid' => $errors->has('name')
        ])/>
        
@error('name')
<div class="invalid-feedback">
    {{ $message }}
    </div>
@enderror
```
- now i will covert every attribute in that input to attribute passed when calling that component
## component
```php
@props(['type'=>'text', 'name', 'value'=>''])
<input type="{{$type}}"
       name="{{$name}}"
       value="{{ old($name, $value) }}"
        {{ $attributes->class([
            'form-control',
            'is-invalid' => $errors->has($name)
        ])/> }}
        {{ that attribute will contain attributes not passed to @props }}
        {{ that attribute class is like stack it contain those classes as intial values if i add any class while defining component there will be added, too }}
@error($name)
<div class="invalid-feedback">
    {{ $message }}
    </div>
@enderror
```
## call component in blade
```php
<x-input name='name' :value="$category->id" />
{{ it must be closed by that /> }}
```
# if i make component for label
## component
```php
@props([
    'id'=>"",
])

<label for="{{ $id }}">{{ $slot }}</label>

{{--slot is the value between tags of label
<form.label>here is the value of slot</form.label>
--}}
```
## to call it
```php
<x-label id='name'>name</x-label>
```