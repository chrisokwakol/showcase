@php
  $style = $style ?? 'simple';
  $bg_image = $bg_image ?? ['image' => ['url' => '']];
@endphp

@if (!empty($title))
  <section id="{{ $block->block->anchor ?? $block->block->id }}" class="media-grid {{ $block->classes }}">
    <div class="container">
      @if ($title)
        <h2 class="media-grid__title">{{ $title }}</h2>
      @endif
      <div class="media-grid__container">
        @foreach ($media as $media)
          @php
            $title = $media['title'];
            $source = $media['embed_url'];
            $poster = $media['poster_image'];
            $transcript = $media['transcript'];
          @endphp
          <section id="{{ $block->block->anchor ?? $block->block->id }}"
            class="lgfb-video lgfb-video--media-grid {{ $source == '' ? 'media-image' : '' }}">
            <div class="lgfb-video__inner container">
              <div class="lgfb-video__content">
                <h3 class="media-grid-title-mobile light-medium show-for-mobile">
                  {{ $title }}</h3>
                <div class="lgfb-video__content">
                  @if ($style == 'fancy')
                    <div class="lgfb-video__background"
                      style="background-image: url('{{ $bg_image['image']['url'] }}');"></div>
                  @endif
                  @if ($poster)
                    <div class="lgfb-video__poster lgfb-video__poster--media-grid">
                      <x-img :image="$poster" class="{{ $style == 'simple' ? 'simple-video-feature-img' : '' }}" />

                      <div class="lgfb-video__poster__play {{ $source == '' ? 'media-image' : '' }}">
                        <button class="play__button play__button--media-grid {{ $source ? '' : 'media-image' }}"
                          tabindex="0" aria-label="Play Video {{ $title ? 'for ' . $title : '' }}">
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

                @if ($title)
                  <div class="media-grid-title-text-transcript">
                    <div class="media-grid-title-transcript">
                      <h3
                        class="media-grid-title-transcript__title desktop light-medium {{ $source ? '' : 'media-image' }}">
                        {{ $title }}
                      </h3>
                      @if ($transcript)
                        <div class="lgfb-video__transcript">
                          <button class="transcript__toggle transcript__toggle--media-grid fs-base bold"
                            aria-expanded="false"
                            aria-controls="transcript-content--{{ $block->block->anchor ?? $block->block->id }}">View
                            Transcript <i class="fa-solid fa-angle-down"></i></button>
                        </div>
                      @endif
                    </div>
                    <div class="transcript__content medium fs-base"
                      id="transcript-content--{{ $block->block->anchor ?? $block->block->id }}" aria-hidden="true"
                      style="display: none;">
                      {!! $transcript !!}
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </section>
        @endforeach
      </div>
    </div>
  </section>
@endif
