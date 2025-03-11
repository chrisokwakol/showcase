@php
  $style = $style ?? 'simple';
  $bg_image = $bg_image ?? ['image' => ['url' => '']];
@endphp

@if (!empty($title))
  <section id="{{ $block->block->anchor ?? $block->block->id }}"
    class="video-instructions {{ $block->classes }} {{ $style }}">
    <div class="video-instructions__container container">
      <div class="video-instructions__inner">
        <h2 class="video-instructions__title">
          {{ $title }}
        </h2>
        <div class="video-instructions__intro fs-base medium">
          {{ $intro }}
        </div>
      </div>
      <div class="video-instructions__content">
        <div class="video-instructions__content__top">
          @if ($instructions)
            @foreach ($instructions as $item)
              @php
                $video = $item['video'];
                $title = $item['title'];
                $source = $item['embed_url'];
                $poster = $item['poster_image'];
                $transcript = $item['transcript'];
              @endphp
              <section id="{{ $block->block->anchor ?? $block->block->id }}"
                class="lgfb-video lgfb-video--video-instructions">
                <div class="lgfb-video__inner container">
                  <div class="lgfb-video__content {{ !$video ? 'media-text-row-img' : '' }}">
                    @if ($item['instruction_list'] && $title)
                      <div class="video-instructions-list-container">
                        <h3 class="video-instructions-list-title light-medium">
                          {{ $title }}</h3>
                        <div class="video-instructions-list">
                          {!! $item['instruction_list'] !!}
                        </div>
                      </div>
                    @endif
                    @if ($poster)
                      <div class="lgfb-video__poster-container">
                        <div class="lgfb-video__poster">
                          <x-img :image="$poster" class="{{ $style == 'simple' }}" />

                          @if ($video)
                            <div class="lgfb-video__poster__play {{ $style ?? '' }}">
                              <button class="play__button" tabindex="0"
                                aria-label="Play Video {{ $title ? 'for ' . $title : '' }}">
                              </button>
                            </div>
                          @endif
                        </div>
                        @if ($video && $transcript)
                          <div class="lgfb-video__transcript {{ $style ?? '' }}">
                            <button class="transcript__toggle transcript__toggle--video-instructions fs-base bold"
                              aria-expanded="false"
                              aria-controls="transcript-content--{{ $block->block->anchor ?? $block->block->id }}">View
                              Transcript <i class="fa-solid fa-angle-down"></i></button>
                            <div class="transcript__content medium fs-base"
                              id="transcript-content--{{ $block->block->anchor ?? $block->block->id }}"
                              aria-hidden="true" style="display: none;">
                              {!! $transcript !!}
                            </div>
                          </div>
                        @endif
                        @if ($video && $source)
                          <div class="lgfb-video__code">
                            {{ $source }}
                          </div>
                        @endif
                      </div>
                    @endif
                  </div>
                </div>
              </section>
            @endforeach
          @endif
        </div>
      </div>

    </div>
  </section>
@endif
