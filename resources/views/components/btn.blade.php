@props([
    'btn' => null,
    'class' => null,
])

@if ($btn !== null && $btn['text'])
    @php
        $id = uniqid('btn-');
        $type = $btn['link_type'];
        switch ($type) {
            case 'internal':
                $link = $btn['internal_link'];
                break;
            case 'external':
                $link = $btn['external_link'];
                break;
            case 'file':
                $link = $btn['file_link'];
                break;
            case 'free':
                $link = $btn['free_link'];
                break;
            case 'modal':
                $link = '#';
                break;
        }
        $size = $btn['size'];
        $style = (!isset($btn['style']) || $btn['style'] == 'primary') ? '' : '-' . $btn['style'];
        $icon = $btn['btn_icon'];
        $open_in_new_tab = $btn['external_link_new-tab'];

        $base_class = 
        'btn-lgfb btn-lgfb--' . $size . ' btn-lgfb-' . $style;

        $modal_class = $type == 'modal' ? 'modal-toggle' : '';
    @endphp

    <a href="{{ $link }}" @if ($btn['external_link'] && $open_in_new_tab) target="_blank" @endif {{ $attributes->merge(['class' => "{$base_class} {$class} {$modal_class}"]) }}
        @if ($type == 'modal') aria-controls="{{ $id }}" aria-expanded="false" @endif>
        {!! $btn['text'] !!}
        @if ($icon)
            {!! $icon !!}
        @endif
    </a>

    @if ($type == 'modal')
        <x-modal :modal="$btn['modal_link']" :id="$id" />
    @endif
@endif
