@php
  if ($source == 'auto') {
    // Get selected taxonomy values from ACF field
    $selected_taxonomies = $taxonomies;

    $args = [
        'post_type' => $post_type,
        'posts_per_page' => 3,
        'tax_query' => [],
    ];

    if (!empty($selected_taxonomies)) {
        foreach ($selected_taxonomies as $selected_value) {
            // Split the selected value to get the taxonomy and term slug
            list($taxonomy, $term_slug) = explode('_', $selected_value);

            // Add tax_query for each selected taxonomy and term
            $args['tax_query'][] = [
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'operator' => 'IN',
                'terms'    => [$term_slug],
            ];
        }

        // Add a relation condition if taxonomies more than 1 so posts to match any selected taxonomies
        if (count($args['tax_query']) > 1) {
            $args['tax_query']['relation'] = 'OR';
        }
    }

    // Fetch the posts
    $query = new WP_Query($args);
    $auto_entries = $query->posts;
  }
@endphp


@if (!empty($title))
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="routing-cards {{ $block->classes }}
        {{ $style == 'white' ? 'routing-cards__bg-white' : ''}}
        {{ $style == 'grey' ? 'routing-cards__bg-grey' : ''}}">
        <div class="container">
            <div class="routing-cards__inner">
              @if ($title || $cta)
                <div class="routing-cards__intro">
                  @if ($title)
                    <h2 class="routing-cards__intro__title light-medium">{{ $title }}</h2>
                  @endif
                  @if ($cta)
                    <x-btn :btn="$cta" class="routing-cards__intro__cta-desktop" />
                  @endif
                </div>
              @endif

              @if ($source == 'manual' && $manual_entries)
                <div class="routing-cards__cards">
                    @foreach ($manual_entries as $item)
                        @if (isset($item['is_active']) && $item['is_active'])
                            <a href="{{ $item['link']['url'] }}" class="routing-cards__cards__card-container">
                                <div class="routing-cards__cards__card-container__card">
                                    @if ($item['image'])
                                        <x-img :image="$item['image']" />
                                    @endif
                                    @if ($item['pre_title'])
                                        <p class="routing-cards__cards__card-container__card__pre-title fs-base bold">{!! $item['pre_title'] !!}</p>
                                    @endif
                                    @if ($item['title'])
                                        <h3 class="routing-cards__cards__card-container__card__title light-medium">{!! $item['title'] !!}</h3>
                                    @endif
                                    @if ($item['text'])
                                        <p class="routing-cards__cards__card-container__card__text fs-base">{!! $item['text'] !!}</p>
                                    @endif
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @if ($cta)
                        <x-btn :btn="$cta" class="routing-cards__cards__cta-mobile" />
                    @endif
                </div>
            @endif

            @if ($source == 'auto')
                <div class="routing-cards__cards">
                    @if (empty($auto_entries)) <!-- Check if $auto_entries is empty -->
                      <p>No posts found matching the selected taxonomies.</p>
                    @else
                        @foreach ($auto_entries as $post)
                          @php
                              $post_id = $post->ID;
                          @endphp
                            <a href="{{ get_permalink($post_id) }}" class="routing-cards__cards__card-container {{ get_post_type($post_id) === 'post' ? 'post-container' : '' }}">
                                <div class="routing-cards__cards__card-container__card">
                                    @if(has_post_thumbnail($post_id))
                                        <img src="{{ get_the_post_thumbnail_url($post_id, 'medium') }}" alt="">
                                    @endif
                                    @if (get_post_type($post_id) == 'post')
                                        <p class="routing-cards__cards__card-container__card__pre-title {{ get_post_type($post_id) === 'post' ? 'post-pre_title' : '' }} fs-base bold">{{ get_the_date('F j, Y', $post_id) }}</p>
                                    @endif
                                    <h3 class="routing-cards__cards__card-container__card__title {{ get_post_type($post_id) === 'post' ? 'post-title' : '' }}">{!! get_the_title($post_id) !!}</h3>
                                    @if (get_post_type($post_id) == 'page')
                                        <p class="routing-cards__cards__card-container__card__text fs-base">{!! get_the_excerpt($post_id) !!}</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                        @if ($cta)
                            <x-btn :btn="$cta" class="routing-cards__cards__cta-mobile" />
                        @endif
                    @endif
                </div>
            @endif
            </div>
        </div>
    </section>
@endif
