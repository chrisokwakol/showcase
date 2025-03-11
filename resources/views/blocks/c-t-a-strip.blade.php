@if (!empty($title))
    <section id="{{ $block->block->anchor ?? $block->block->id }}"
        class="cta-strip cta-strip--{{ $vertical_padding }} {{ $block->classes }} 
    {{ $style == 'theme_one' ? 'cta-strip--theme-one' : '' }} 
    {{ $style == 'theme_two' ? 'cta-strip--theme-two' : '' }} 
    {{ $style == 'theme_three' ? 'cta-strip--theme-three' : '' }}
    {{ $style == 'theme_four' ? 'cta-strip--theme-four' : '' }}
    {{ $style == 'theme_five' ? 'cta-strip--theme-five' : '' }}
    @if ($image['image']) cta-strip__has-image @endif">
        <div class="container">
            @if ($image['image'])
                <div class="cta-strip__image-container">
                    <x-img :image="$image" class="cta-strip__image-container__image" />
                    <div class="cta-strip__image-container__img-bg"></div>
                </div>
            @else
                {{-- <div class="cta-strip__bg-mobile show-for-mobile"></div>   --}}
            @endif
            <div class="cta-strip__inner">
                @if ($title)
                    <h2 class="cta-strip__title">{{ $title }}</h2>
                @endif
                @if ($text)
                    <p class="cta-strip__text medium">{{ $text }}</p>
                @endif
                <div class="cta-strip__ctas">
                    @if ($cta_one)
                        <x-btn :btn="$cta_one" class="cta-strip__ctas__cta cta-strip__ctas__cta--one" />
                    @endif
                    @if ($cta_two)
                        <x-btn :btn="$cta_two" class="cta-strip__ctas__cta cta-strip__ctas__cta--two" />
                    @endif
                </div>

                {{-- Render Search Form if passed in Blog Landing --}}
                {!! $blog_landing_search_form ?? '' !!}

                {{-- Render Gloabal Search Form if passed in Search Blade --}}
                {!! $global_search_form ?? '' !!}
            </div>
        </div>
    </section>
@endif
