@props(['type'=>'text','name', 'value'=>'', 'label'=>false])
{{-- if i wnat to use $attributes i must use props with it --}}

@if ($label)
<label for="">{{ $label }}</label>
@endif
<input type="{{ $type }}"
name="{{ $name }}"
value="{{ old($name, $value) }}"
{{ $attributes->class([
    'form-control',
    'is-invalid' => $errors->has($name)
]) }}
@class([
    'form-control',
    'is-invalid' => $errors->has($name) // if there is error is-invalid will add to class list
])
/>
@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
