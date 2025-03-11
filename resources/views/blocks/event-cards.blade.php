@php
  if (!empty($manual_events)) {
    $posts = get_posts([
      'post_type' => ['event', 'speaker_series'], 
      'post__in' => $manual_events, 
      'orderby' => 'post__in',
  ]);
  } elseif (empty($posts)) {
    // Default query if manual_events is empty
    if ($content_type == 'events') {
      $posts = get_posts([
          'post_type' => 'event',
          'posts_per_page' => -1,
          'orderby' => 'date',
          'order' => 'ASC',
      ]);
    } elseif ($content_type == 'speaker_series') {
      $posts = get_posts([
          'post_type' => 'speaker_series',
          'posts_per_page' => -1,
          'orderby' => 'date',
          'order' => 'ASC',
      ]);
    }
  }
@endphp


@if (!empty($title) || is_admin())
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="event-cards {{ $block->classes }}">
        <div class="container">
            <div class="event-cards__inner">
                <div class="event-cards__top">
                  <h2 class="event-cards__top__title">{{ $title }}</h2>
                  @if ($cta)
                    <x-btn :btn="$cta" class="event-cards__top__desktop-cta"/>
                  @endif
                </div>
                <div class="event-cards__cards-container">
                  @if ($posts)
                    @foreach ($posts as $post)
                      @php
                          // Fetch all ACF fields
                          $fields = get_fields($post->ID);

                          // Assign individual variables for easy use
                          $featured_image = get_the_post_thumbnail($post->ID, 'full');
                          $title = get_the_title($post->ID);
                          $date = $fields['event_speaker_date'] ?? '';
                          $time = $fields['event_speaker_time'] ?? '';
                          $summary = $fields['event_speaker_summary'] ?? '';
                          $terms = get_the_terms($post->ID, 'topic');
                          $is_speaker_series = $post->post_type == 'speaker_series';
                          $detail_page_url = $is_speaker_series ? get_permalink($post->ID) : '';
                      @endphp
                      @if ($is_speaker_series)
                          <a href="{{ $detail_page_url }}" class="event-cards__cards-container__card event-cards__cards-container__card--speaker-series">
                      @else
                          <div class="event-cards__cards-container__card">
                      @endif
                          @if ($featured_image)
                            <div class="event-cards__cards-container__card__featured-image">
                              {!! $featured_image !!}
                            </div>
                          @endif
                          <div class="event-cards__cards-container__card__info">
                            <div class="event-cards__cards-container__card__info__summary">
                              @if ($title)
                                <h3 class="lgfb-event-cards-title light-medium">{{ $title }}</h3>  
                              @endif
                              @if ($summary)
                                <p class="lgfb-event-cards-summary fs-base">{{ $summary }}</p>  
                              @endif

                              @if ($terms)
                                <div class="event-cards__cards-container__card__info__summary__terms">
                                  @foreach ($terms as $term)
                                    <div class="event-cards__cards-container__card__info__summary__terms__term bold fs-base">
                                      {!! $term->name !!}
                                    </div>
                                  @endforeach
                                </div>
                              @endif

                            </div>
                            @if ($date)
                              <div class="event-cards__cards-container__card__info__meta">
                                <div class="event-cards__cards-container__card__info__meta__date @if (!$time) no-time @endif">
                                  @php
                                      $day_month = date('M j', strtotime($date));
                                      $year = date('Y', strtotime($date));
                                      $time_zone = 'EST';
                                  @endphp
                                  <div class="lgfb-ec-date-inner">
                                    <span class="lgfb-ec-day-month fs-2xl">{{ $day_month }}</span> 
                                    <span class="lgfb-ec-year fs-base">{{ $year }}</span>
                                  </div>
                                </div>
                                @if ($time)
                                  <div class="event-cards__cards-container__card__info__meta__time">
                                    <div class="lgfb-ec-time-inner">
                                      <span class="lgfb-ec-day-time fs-base">{{ $time }}</span>
                                      <span class="lgfb-ec-day-timezone fs-base">{{ $time_zone }}</span>
                                    </div>
                                  </div>
                                @endif
                              </div>
                            @endif
                          </div>
                      @if ($is_speaker_series)
                          </a>
                      @else
                          </div>
                      @endif
                    @endforeach
                  @endif
                  @if ($cta)
                    <x-btn :btn="$cta" class="event-cards__cards-container__mobile-cta"/>
                  @endif
                </div>
                <x-editor-notification :condition="empty($posts) && !$title" level="info">
                  <h2>Event Cards</h2>
                  <p>Add some content to this block to get started.</p>
                </x-editor-notification>
            </div>
        </div>
    </section>
@endif
