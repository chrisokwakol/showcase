@if (!empty($buttons) || is_admin())
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="button-grid {{ $block->classes }}@if (!$title && !$background) btn-grid-simple @endif" @if ($background == 'true') style="background: #ECEDEC;" @endif>
        <div class="container">
            <div class="button-grid__inner">
              @if ($title)
                <h2 class="button-grid__title">{{ $title }}</h2>
              @endif
              <div class="button-grid__button-container">
                @foreach ($buttons as $button)
                    @if (isset($button['button']))
                        <x-btn :btn="$button['button']" class="button-grid__button-container__button"/>
                    @endif
                @endforeach
              </div>
            </div>
            <x-editor-notification :condition="empty($buttons)" level="info">
              <h2>Button Grid</h2>
              <p>Add some content to this block to get started.</p>
            </x-editor-notification>
        </div>
    </section>
@endif
