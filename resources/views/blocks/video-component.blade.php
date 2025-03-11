<section id="{{ $block->block->anchor ?? $block->block->id }}"
  class="lgfb-video {{ $style == 'fancy' ? 'fancy-video-feature' : '' }}">
  <div class="lgfb-video__inner container">
    <div class="lgfb-video__top">
      @if ($title)
        <h2 class="lgfb-video__title">
          {{ $title }}
        </h2>
      @endif
      @if ($description)
        <div class="lgfb-video__description fs-base medium">
          {!! $description !!}
        </div>
      @endif
    </div>

    <div class="lgfb-video__content {{ $style == 'fancy' ? 'fancy-content' : '' }}">
      @if ($style == 'fancy')
        <div class="lgfb-video__background" style="background-image: url('{{ $bg_image['image']['url'] }}');"></div>
      @endif
      @if ($poster)
        <div class="lgfb-video__poster">
          <x-img :image="$poster" class="{{ $style == 'simple' ? 'simple-video-feature-img' : '' }}" />

          <div class="lgfb-video__poster__play {{ $style == 'simple' ? 'simple-video-poster' : '' }}">
            <button class="play__button" tabindex="0" aria-label="Play Video {{ $title ? 'for ' . $title : '' }}">
            </button>
          </div>

        </div>
      @endif
      @if ($source)
        <div class="lgfb-video__code">
          {{ $source }}
        </div>
      @endif
    </div>

    @if ($transcript)
      <div class="lgfb-video__transcript {{ $style == 'fancy' ? 'fancy-transcript' : '' }}">
        <button class="transcript__toggle fs-base bold" aria-expanded="false"
          aria-controls="transcript-content--{{ $block->block->anchor ?? $block->block->id }}">View Transcript <i
            class="fa-solid fa-angle-down"></i></button>
        <div class="transcript__content medium fs-base"
          id="transcript-content--{{ $block->block->anchor ?? $block->block->id }}" aria-hidden="true"
          style="display: none;">
          {!! $transcript !!}
        </div>
      </div>
    @endif
  </div>
</section>
