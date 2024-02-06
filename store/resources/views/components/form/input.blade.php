@props(['type'=>'text','name', 'value'=>'', 'label'=>false])
{{-- if i wnat to use $attributes i must use props with it --}}
{{--what is defined inside @props is not printed by $attributes  variable--}}

@if ($label)
    <label for="">{{ $label }}</label>
@endif

<input type="{{ $type }}"
       name="{{ $name }}"
       value="{{ old($name, $value) }}"
        {{-- {{$attributes}} variable print the other attributes that not defined in @props but sent in component--}}
        {{ $attributes->class([
            'form-control',
            'is-invalid' => $errors->has($name)
        ]) }}
        {{--that $attributes->class is like stack if i add other classes while defining component it will be added to it--}}
/>

@error($name)
<div class="invalid-feedback">
    {{ $message }}
    </div>
@enderror
