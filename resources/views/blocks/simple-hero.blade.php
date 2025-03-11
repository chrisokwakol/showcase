@if ($title || is_admin())
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="simple-hero {{ $block->classes }}">
      <div class="simple-hero__inner">
        <div class="simple-hero__container container">
          <div class="simple-hero__content simple-hero__content--left">
            @if ($pre_title)
              <h3 class="simple-hero__pre-title">{{ $pre_title }}</h3>
            @endif
            @if ($title)
              <h1 class="simple-hero__title">{{ $title }}</h1>
            @endif
            @if (!empty($image_mobile['image']))
              <x-img :image="$image_mobile" class="simple-hero__image simple-hero__image--mobile show-for-mobile" />
            @elseif(!empty($image_desktop['image']))
              <x-img :image="$image_desktop" class="simple-hero__image simple-hero__image--mobile show-for-mobile" />
            @endif
            @if ($text)
              <p class="simple-hero__text">{{ $text }}</p>
            @endif
          </div>
          <div class="simple-hero__content simple-hero__content--right">
            @if (!empty($image_desktop['image']))
              <x-img :image="$image_desktop" class="simple-hero__image simple-hero__image--desktop show-for-desktop" />
            @endif
          </div>
        </div>
        <x-editor-notification :condition="!$title" level="info">
          <h2>Simple Hero</h2>
          <p>Add some content to this block to get started.</p>
        </x-editor-notification>
      </div>
    </section>
@endif
