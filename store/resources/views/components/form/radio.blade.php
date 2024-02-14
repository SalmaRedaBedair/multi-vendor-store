@props(['name', 'options', 'checked' => false])

@foreach ($options as $key => $value)
    <div {{ $attributes->merge(['class' => 'form-check ' . ($errors->has($name) ? 'is-invalid' : '')]) }}>
        <input type="radio" name="{{ $name }}" id="{{ $key }}" @if(old($name, $checked) == $key) checked @endif
        value="{{ $key }}" {{ $attributes->merge(['class' => 'form-check-input ' . ($errors->has($name) ? 'is-invalid' : '')]) }}/>
        <label for="{{ $key }}" class="form-check-label">{{ $value }}</label>
    </div>
@endforeach

@error($name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
