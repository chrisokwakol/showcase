@props([
    'heading' => null,
    'level' => 2,
    'class' => null,
])

@if ($heading !== null && $heading['text'])
    @php($underline_class = $heading['add_underline'] ? 'h-underline' : '')

    <h{{ $level }} {{ $attributes->merge(['class' => "{$underline_class} {$class}"]) }}>
        {!! $heading['text'] !!}
        </h{{ $level }}>
@endif
