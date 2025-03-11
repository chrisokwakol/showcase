@if (!empty($title))
  <section id="{{ $block->block->anchor ?? $block->block->id }}" class="numbered-instructions {{ $block->classes }}">
    <div class="numbered-instructions__container container">
      <div class="numbered-instructions__top">
        @if ($title)
          <h2 class="numbered-instructions__title">{{ $title }}</h2>
        @endif
        @if ($intro)
          <p class="numbered-instructions__intro medium">{!! $intro !!}</p>
        @endif
      </div>
      <div class="numbered-instructions__bottom">
        @if ($image)
          <div class="numbered-instructions__image">
            <x-img :image="$image" class="numbered-instructions__image-img" />
          </div>
        @endif
        @if ($list)
          <ol class="numbered-instructions__list">
            @foreach ($list as $instruction)
              <li class="numbered-instructions__item">
                <p class="numbered-instructions__item-text">{!! $instruction['instruction_item'] !!}</p>
              </li>
            @endforeach
          </ol>
        @endif
      </div>
    </div>
  </section>
@endif
