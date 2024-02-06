@props([
    'id'=>"",
])

<label for="{{ $id }}">{{ $slot }}</label>

{{--slot is the value between tags of label
<form.label>here is the value of slot</form.label>
--}}
