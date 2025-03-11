@if (!empty($text))
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="hero {{ $block->classes }}">
      <div class="hero__inner">
        <div class="hero__container container">
          <div class="hero__container__content__left">
            @if ($text)
              <h1 class="hero__container__content__left__title">{!! $text !!}</h1>
            @endif
            @if ($cta)
              <x-btn :btn="$cta" class="hero__container__content__left__cta"/>
            @endif
          </div>
          <div class="hero__container__content__right">
            @if ($image_desktop)
                <x-img :image="$image_desktop" class="hero__container__content__right__img-desktop"/>
            @endif
            @if ($image_mobile)
              <x-img :image="$image_mobile" class="hero__container__content__right__img-mobile"/>
            @endif
          </div>
        </div>
      </div>
    </section>
@endif
