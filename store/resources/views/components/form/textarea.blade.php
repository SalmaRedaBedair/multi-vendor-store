@props(['name', 'value'=>'', 'label'=>false])
{{-- if i wnat to use $attributes i must use props with it --}}

@if ($label)
<label for="">{{ $label }}</label>
@endif
<textarea
name="{{ $name }}"
{{ $attributes->class([
    'form-control',
    'is-invalid' => $errors->has($name)
]) }}
@class([
    'form-control',
    'is-invalid' => $errors->has($name) // if there is error is-invalid will add to class list
])
>{{ old($name, $value) }}</textarea>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
