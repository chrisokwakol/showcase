{{--
  Template Name: Blog Landing
--}}

@extends('page')

@section('content')
    {{-- Hero --}}
    @php
        $hero_title = get_field('blog_landing_hero_title', 'options');
        $hero_text = get_field('blog_landing_hero_text', 'options');
        $form_title = get_field('blog_landing_search_form_title', 'options');
        $form_btn_text = get_field('blog_landing_search_form_button_text', 'options');
    @endphp

    <div class="blog-landing__cta-strip">
        @includeWhen(class_exists(\App\Blocks\CTAStrip::class), 'blocks.c-t-a-strip', [
            'block' => (object) [
                'block' => (object) ['anchor' => 'c-t-a-strip'],
                'classes' => '',
            ],
            'title' => $hero_title,
            'style' => 'theme_three',
            'text' => $hero_text,
            'blog_landing_search_form' =>
                '<form name="blog-landing-search" class="blog-landing-search-form js-blog-search-form">' .
                '<p class="blog-landing-form-title">' .
                $form_title .
                '</p>' .
                '<input type="text" name="blog-landing-search" value="' .
                get_search_query() .
                '">' .
                '<button class="bold btn-lgfb btn-lgfb--medium" type="submit">' .
                $form_btn_text .
                '<i></i></button>' .
                '</form>',
            'vertical_padding' => '',
            'image' => ['image' => null],
            'cta_one' => null,
            'cta_two' => null,
        ])
    </div>

    @php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        // Check for both possible search parameters
        $search_term = '';
        if (isset($_GET['blog-landing-search'])) {
            $search_term = sanitize_text_field($_GET['blog-landing-search']);
        } elseif (isset($_GET['s'])) {
            $search_term = sanitize_text_field($_GET['s']);
        }

        $search_query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 10,
            'paged' => $paged,
            's' => $search_term,
        ]);

        // Calculate the displayed posts count
        $total_posts = $search_query->found_posts;
        $posts_per_page = $search_query->query_vars['posts_per_page'];
        $displayed_posts = $search_query->post_count;

        // Topic taxonomy terms
        $topic_tax_terms = get_terms([
            'taxonomy' => 'topic',
            'hide_empty' => true,
        ]);

        $treatment_stage_tax_terms = get_terms([
            'taxonomy' => 'treatment-stage',
            'hide_empty' => true,
        ]);

        $audience_type_tax_terms = get_terms([
            'taxonomy' => 'audience-type',
            'hide_empty' => true,
        ]);
    @endphp

    <div class="blog-landing__search-wrapper" data-page-type="blog-landing">
        <div class="container">
            <div class="blog-landing__search">
                <div class="blog-landing__search__filters-container">
                    <div class="blog-landing__search__filters">
                        <h3 class="blog-landing__search__filters__filter-title">{{ __('Filter By', 'lgfb') }}</h3>

                        <div class="blog-landing__search__filters__taxonomy blog-landing__search__filters__taxonomy--topic">
                            <div class="taxonomy-title-container">
                                <div class="taxonomy-title-container__inner">
                                    <button class="taxonomy-title-button" aria-expanded="true">
                                        <h4 class="taxonomy-title taxonomy-title--topic">{{ __('Topic', 'lgfb') }} <span
                                                class="taxonomy-count"></span>
                                        </h4>
                                        <i class="fa-solid fa-minus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            @if (!empty($topic_tax_terms) && !is_wp_error($topic_tax_terms))
                                <ul class="topic-taxonomy__list">
                                    @foreach ($topic_tax_terms as $term)
                                        <li>
                                            <label class="filter-checkbox fs-sm">
                                                <input type="checkbox" class="filter-checkbox__input" name="topic_filters[]"
                                                    value="{{ esc_attr($term->slug) }}">
                                                <span class="filter-checkbox__custom"></span>
                                                {!! $term->name !!}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div
                            class="blog-landing__search__filters__taxonomy blog-landing__search__filters__taxonomy--treatment-stage">
                            <div class="taxonomy-title-container">
                                <div class="taxonomy-title-container__inner">
                                    <button class="taxonomy-title-button" aria-expanded="false"
                                        data-taxonomy="treatment-stage">
                                        <h4 class="taxonomy-title taxonomy-title--treatment-stage">
                                            {{ __('Treatment Stage', 'lgfb') }} <span class="taxonomy-count"></span></h4>
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            @if (!empty($treatment_stage_tax_terms) && !is_wp_error($treatment_stage_tax_terms))
                                <ul class="topic-taxonomy__list">
                                    @foreach ($treatment_stage_tax_terms as $term)
                                        <li>
                                            <label class="filter-checkbox fs-sm">
                                                <input type="checkbox" class="filter-checkbox__input"
                                                    name="treatment-stage_filters[]" value="{{ esc_attr($term->slug) }}">
                                                <span class="filter-checkbox__custom"></span>
                                                {!! $term->name !!}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div
                            class="blog-landing__search__filters__taxonomy blog-landing__search__filters__taxonomy--audience-type">
                            <div class="taxonomy-title-container">
                                <div class="taxonomy-title-container__inner">
                                    <button class="taxonomy-title-button" aria-expanded="false"
                                        data-taxonomy="audience-type">
                                        <h4 class="taxonomy-title taxonomy-title--audience-type">
                                            {{ __('Audience Type', 'lgfb') }} <span class="taxonomy-count"></span></h4>
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            @if (!empty($audience_type_tax_terms) && !is_wp_error($audience_type_tax_terms))
                                <ul class="topic-taxonomy__list">
                                    @foreach ($audience_type_tax_terms as $term)
                                        <li>
                                            <label class="filter-checkbox fs-sm">
                                                <input type="checkbox" class="filter-checkbox__input"
                                                    name="audience-type_filters[]" value="{{ esc_attr($term->slug) }}">
                                                <span class="filter-checkbox__custom"></span>
                                                {!! $term->name !!}

                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="blog-landing__search__filters__filter-buttons">
                            <a href="" class="btn-lgfb btn-lgfb--medium blog-landing-apply-filter-btn"
                                data-nonce="{{ wp_create_nonce('blog_landing_nonce') }}"
                                data-url="{{ admin_url('admin-ajax.php') }}">
                                {{ __('Apply Selected Filters', 'lgfb') }} <span
                                    class="blog-landing-apply-filter-btn__taxonomy-count"></span>
                            </a>
                            <a href=""
                                class="btn-lgfb btn-lgfb--medium btn-lgfb--outline blog-landing-clear-filter-btn">
                                {{ __('Clear Selected Filters', 'lgfb') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="blog-landing__search__results">
                    <p class="blog-landing__search__search-results-info"> {{ __('Displaying', 'lgfb') }} <span
                            class="medium">{{ $displayed_posts }}
                            {{ __('of', 'lgfb') }}
                            {{ $total_posts }}</span> {{ __('Results', 'lgfb') }}
                    </p>
                    <div class="blog-landing__search__results__posts">
                        @if ($search_query->have_posts())
                            @while ($search_query->have_posts())
                                @php
                                    $search_query->the_post();
                                    $main_topic_id = get_field('blog_detail_main_topic');

                                    if ($main_topic_id) {
                                        $main_topic = get_term($main_topic_id);
                                        $main_topic_name = $main_topic ? $main_topic->name : '';
                                    } else {
                                        $main_topic_name = '';
                                    }
                                @endphp
                                <div class="blog-landing__search__results__posts__post">
                                    <a href="{{ get_permalink() }}"
                                        class="blog-landing__search__results__posts__post--link">
                                        <div class="blog-landing__search__results__posts__post--inner">
                                            @if (has_post_thumbnail())
                                                <div class="lgfb-blog-landing-post-thumbnail">
                                                    {!! get_the_post_thumbnail(null, 'thumbnail') !!}
                                                </div>
                                            @endif
                                            <div
                                                class="lgfb-blog-landing-post-content {{ !has_post_thumbnail() ? 'no-thumbnail' : '' }}">
                                                <p class="post-category">{!! $main_topic_name !!}</p>
                                                <p class="post-date">{{ get_the_date() }}</p>
                                                <h4 class="post-title">{!! get_the_title() !!}</h4>
                                                <p>{{ wp_trim_words(get_the_excerpt(), 17, '...') }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endwhile
                            @php wp_reset_postdata() @endphp
                        @else
                            <p>{{ __('No blog posts found.', 'lgfb') }}</p>
                        @endif
                    </div>
                    {{-- Pagination --}}
                    <div class="blog-landing__pagination">
                        @php
                            $big = 999999999;
                            echo paginate_links([
                                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                'format' => '?paged=%#%',
                                'current' => max(1, get_query_var('paged')),
                                'total' => $search_query->max_num_pages,
                                'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                                'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
                            ]);
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    @php the_content() @endphp
@endsection
