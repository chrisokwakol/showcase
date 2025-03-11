<section id="{{ $block->block->anchor ?? $block->block->id }}" class="stat-columns {{ $block->classes }}">
    <div class="container">
        <div class="stat-columns__inner">
          <div class="stat-columns__inner__top-half">
            <div class="left">
              @if ($title)
                <h2 class="title">{{ $title }}</h2>  
              @endif
              @if ($text)
                <p class="fs-base medium">{{ $text }}</p>  
              @endif
            </div>
              @if (!empty($cta) && (!empty($cta['internal_link']) || !empty($cta['external_link'])))
                <div class="right">
                  <x-btn :btn="$cta" class="bold fs-base" />
                </div>
              @endif
          </div>
          @if ($stats)
            <div class="stat-columns__inner__lower-half">
              @foreach ($stats as $stat)
                  <div class="stat-info">
                    @if($stat['value'])
                      <div>
                        <h1 class="stat-info__value light-medium">
                            {{ $stat['value'] }}
                        </h1>
                        <div class="stat-info-spacer"></div>
                      </div>
                    @endif
                    @if($stat['subject'])
                      <div>
                        <p class="stat-info__subject fs-lg medium">
                            {!! $stat['subject'] !!}
                        </p>
                      </div>
                    @endif
                    @if($stat['text'])
                      <div>
                        <p class="stat-info__text fs-base medium">
                            {!! $stat['text'] !!}
                        </p>
                      </div>
                    @endif
                  </div>
              @endforeach
            </div>
          @endif
        </div>
    </div>
</section>

