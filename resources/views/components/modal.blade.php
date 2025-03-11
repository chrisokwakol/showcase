@props([
    'modal' => null,
    'id' => null,
])

@if ($modal !== null)
    @php
        // Fields
        $modal_id = $modal[0]->ID;
        $modal_title = get_field('modal_title', $modal_id);
        $modal_description = get_field('modal_description', $modal_id);
    @endphp
    <div class="modal__wrap" id="{{ $id }}">
        <div class="modal__card" role="dialog" aria-labelledby="modal__title-{{ $modal_id }}"
            aria-describedby="modal__description-{{ $modal_id }}">
            <div class="modal__inner">
                <div class="modal__top">
                    <h2 id="modal__title-{{ $modal_id }}" class="modal__title">{!! $modal_title !!}</h2>
                    <button class="modal__close" aria-label="Close modal" type="button" aria-expanded="true"
                        aria-controls={{ $id }}>
                        <i class="fa-solid fa-close"></i>
                    </button>
                </div>
                <div class="modal__content">
                    <div id="modal__description-{{ $modal_id }}" class="modal__description">{!! $modal_description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal__overlay" aria-hidden="true"></div>
    </div>
@endif
