@if (!empty($rich_text) || is_admin())
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="lgfb-rich-text {{ $block->classes }}">
        <div class="container">
            <div class="lgfb-rich-text__inner">
                @if ($rich_text)
                  {!! $rich_text !!}
                @endif
            </div>
            <x-editor-notification :condition="empty($rich_text)" level="info">
              <h2>Rich Text</h2>
              <p>Add some content to this block to get started.</p>
            </x-editor-notification>
        </div>
    </section>
@endif
