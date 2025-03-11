{{--
  Template Name: Resources Landing
--}}

@extends('page')

@section('content')
{{-- Hero --}}
  @php
      $cta = get_field('resources_cta');
      $back_to_resources_url = get_field('resources_hub_page', 'options');
      $title = get_field('resources_title');
      $text = get_field('resources_intro');
      $image = get_the_post_thumbnail_url();
  @endphp
  @if ($title || is_admin())
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="simple-hero simple-hero--resource-landing {{ $block->classes }}">
      <div class="simple-hero__inner">
        <div class="simple-hero__container container">
          <div class="simple-hero__content simple-hero__content--left">
            <a href="{{ $back_to_resources_url }}" class="resources-landing__go-back-btn fs-base">Back to Resources</a>
            @if ($title)
              <h1 class="simple-hero__title">{{ $title }}</h1>
            @endif
            @if (!empty($image))
              <img src="{{ $image }}" alt="{{ $title }}" class="simple-hero__image simple-hero__image--mobile show-for-mobile">
            @endif
            @if ($text)
              <p class="simple-hero__text">{{ $text }}</p>
            @endif
            <x-btn :btn="$cta" class="resource-landing__cta"/>
          </div>
          <div class="simple-hero__content simple-hero__content--right">
            @if (!empty($image))
              <img src="{{ $image }}" alt="{{ $title }}" class="simple-hero__image simple-hero__image--desktop show-for-desktop">
            @endif
          </div>
        </div>
      </div>
    </section>
  @endif

  {{-- All Resources --}}
  @php
    $related_posts = get_field('related_resources');
  @endphp

  <div class="resources-landing__list">
    <div class="resources-landing__list__container container">
        <h2 class="resources-landing__list__title">All Resources</h2>

        @php
            $related_posts = get_field('related_resources');
        @endphp

        @if ($related_posts)
            <div class="resources-landing__list__items">
                @foreach ($related_posts as $post_id)
                    @php
                        $related_post = get_post($post_id);
                        setup_postdata($related_post);
                    @endphp

                    {{-- Resource Item Desktop --}}
                    <a href="{{ get_permalink($related_post) }}" class="resources-landing__list__items__item">
                        @if (has_post_thumbnail($related_post))
                            <div class="resource-item__image">
                                <img src="{{ get_the_post_thumbnail_url($related_post, 'medium') }}" alt="{{ get_the_title($related_post) }}">
                            </div>
                        @endif
                        <div class="resource-item__text">
                          <p class="resource-item__title fs-lg medium">{!! get_the_title($related_post) !!}</p>
                        </div>
                    </a>

                    {{-- Resource Item Mobile --}}
                    <div class="resources-landing__list__items__item resources-landing__list__items__item--mobile">
                      <a href="{{ get_permalink($related_post) }}" target="_blank" class="btn-lgfb btn-lgfb--outline btn-lgfb--medium btn-lgfb-">{!! get_the_title($related_post) !!}
                        <i class="fa-classic fa-solid fa-arrow-right" aria-hidden="true"></i>
                      </a>
                    </div>

                @endforeach

                @php wp_reset_postdata(); @endphp
            </div>
        @else
            <p>No related posts found.</p>
        @endif
    </div>
  </div>

  @php the_content() @endphp
@endsection
