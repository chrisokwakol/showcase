@if (!empty($quote) || is_admin())
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="pull-quote {{ $block->classes }}">
        <div @if ($style == 'contained') class="container" @endif>
            <div class="pull-quote__inner" @if ($style == 'full width') id="pull-quote-full-width" @endif>
              <div class="content">
                <div class="content__quote-icon"></div>
                <div class="content__quote-content">
                  @if (!empty($quote))
                    <h3 class="quote pull-quote-header light-medium">{{ $quote }}</h3>
                  @endif
                  @if ($author)
                    <p class="author-name fs-lg bold">{{ $author }}</p>  
                  @endif
                  @if ($byline)
                    <p class="author-info medium">{{ $byline }}</p>  
                  @endif
                  <x-editor-notification :condition="empty($quote) && !$author && !$byline" level="info">
                    <h2>Pull Quote</h2>
                    <p>Add some content to this block to get started.</p>
                  </x-editor-notification>
                </div>
              </div>
            </div>
        </div>
    </section>
@endif
