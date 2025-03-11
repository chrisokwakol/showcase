@if (!empty($title) || is_admin())
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="inline-form {{ $block->classes }} 
      {{ $style == 'white' ? 'inline-form__bg-white' : ''}} 
      {{ $style == 'hibiscus' ? 'inline-form__bg-hibiscus' : ''}} ">
        <div class="container">
            <div class="inline-form__inner">
              <div class="inline-form__intro">
                <h2 class="inline-form__intro__title">{{ $title }}</h2>
                <p class="inline-form__intro__text">{{ $intro }}</p>
              </div>
              <div class="inline-form__form">
                @if ($form_id)
                  @php
                      $short_code = "[gravityform id=\"{$form_id}\" title=\"true\" description=\"false\"]";
                  @endphp
                  {!! do_shortcode($short_code) !!}
                @endif
              </div>
              <x-editor-notification :condition="empty($title)" level="info">
                <h2>Inline Form</h2>
                <p>Add some content to this block to get started.</p>
              </x-editor-notification>
            </div>
        </div>
    </section>
@endif
