@props(['name', 'options', 'checked' => false])

@foreach ($options as $key => $value)
    <div class="form-check">
        <input type="radio" name="{{ $name }}" id="{{ $value }}" @checked(old($name, $checked) == $value)
            value="{{ $value }}"
            {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }} />
        <label for="{{ $value }}" class="form-check-label">{{ $key }}</label>
    </div>
@endforeach
