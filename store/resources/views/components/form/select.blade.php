@props(['name', 'selected' => old($name, $selected), 'label' => false, 'options'])

@if ($label)
    <label for="">{{ $label }}</label>
@endif

<select name="{{ $name }}"
    {{ $attributes->class(['form-control', 'form-select', 'is-invalid' => $errors->has($name)]) }}>
    <option value="">Primary value</option>
@foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
    @endforeach
</select>

@error($name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
