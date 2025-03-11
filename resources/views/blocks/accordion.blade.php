@if (!empty($accordions))
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="accordion-block {{ $block->classes }}">
        <div class="container">
            <div class="accordion-block__inner">

                @foreach ($accordions as $index => $accordion)
                    <div class="lgfb-accordion">
                        <div class="lgfb-accordion__top">
                            <button class="lgfb-accordion__toggle" type="button"
                                id="{{ $block->block->id }}__accordion-{{ $index }}-header"
                                aria-expanded="false"
                                aria-controls="{{ $block->block->id }}__accordion-{{ $index }}-content">
                                <h4 class="toggle__title">{!! $accordion['title'] !!}</h4>
                                <span class="toggle__icon">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                            </button>
                        </div>

                        <div class="lgfb-accordion__content"
                            id="{{ $block->block->id }}__accordion-{{ $index }}-content" role="region"
                            aria-labelledby="{{ $block->block->id }}__accordion-{{ $index }}-header">
                            <div class="lgfb-accordion__content__inner" aria-hidden="true" style="display: none;">
                                <div class="lgfb-accordion__content__inner__text">
                                    {!! $accordion['text'] !!}
                                </div>
                                @if ($accordion['image'])
                                    <x-img :image="$accordion['image']" class="lgfb-accordion__content__inner__image"/>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endif
