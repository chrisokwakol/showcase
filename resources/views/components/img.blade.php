@props([
    'image' => null,
    'class' => '',
    'default' => false,
    'lazy' => true,
])

@php
    if ($default) {
        $image = !empty($image) && !empty($image['image']) ? $image : $global_default_image;
    }
@endphp


@if ($image !== null && $image['image'])
    @php
        $image1x = $image['image'] ? $image['image']['url'] : '';
        $imageAlt = $image['image'] ? $image['image']['alt'] : '';
        $isLazy = $lazy && $image['lazy_load'];
        $lazyAttr = $isLazy ? 'lazy' : 'auto';
        $classes = $isLazy ? 'lazy' : 'no-lazy';
        $retina = $image['retina_version'];
        $image2x = $retina ? ($image['image_2x'] ? $image['image_2x']['url'] : '') : '';
        $src_set = $isLazy ? 'data-srcset="' : 'srcset="';
    @endphp

    <img {{ $attributes->merge([
        'class' => "{$classes} {$class}",
        'src' => $image1x,
        'alt' => $imageAlt,
        'loading' => $lazyAttr,
    ]) }}
        {!! $retina == 1
            ? $src_set . ($image1x != '' ? $image1x . ' 1x,' : '') . ($image2x != '' ? $image2x . ' 2x' : '') . '"'
            : '' !!} />
@endif
