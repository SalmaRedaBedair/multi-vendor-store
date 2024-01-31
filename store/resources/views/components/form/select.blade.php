@props(['name', 'selected' => '', 'label' => false, 'options'])

@if ($label)
    <label for="">{{ $label }}</label>
@endif

<select name="{{ $name }}"
    {{ $attributes->class(['form-control', 'form-select', 'is-invalid' => $errors->has($name)]) }}>
    <option value="">Primary value</option>
@foreach ($options as $value => $text)
        @if(is_object($text))
            <option value="{{ $text->id }}" @selected($text->id == $selected)>{{ $text->name }}</option>
        @else
        <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
        @endif
    @endforeach
</select>

