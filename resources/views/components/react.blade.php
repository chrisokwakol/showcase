@props ([
  'component' => null,
  'properties' => [],
])

@if($component !== null && $component !== '')
  @php
    $name = str_replace(' ', '', $component);
  @endphp
  <div
    {{ $attributes }}
    data-react-component="{!! $name !!}"
  >
    <div data-react-props style="display: none !important;">
      {!! json_encode($properties) !!}
    </div>
  </div>
@endif
