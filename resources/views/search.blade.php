@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    @php
        $hero_title = get_field('global_search_hero_title', 'options');
        $hero_text = get_field('global_search_hero_text', 'options');
        $form_title = get_field('global_search_form_title', 'options');
        $form_btn_text = get_field('global_search_form_button', 'options');
    @endphp

    <div class="blog-landing__cta-strip blog-landing__cta-strip--global-search">
        @includeWhen(class_exists(\App\Blocks\CTAStrip::class), 'blocks.c-t-a-strip', [
            'block' => (object) [
                'block' => (object) ['anchor' => 'c-t-a-strip'],
                'classes' => '',
            ],
            'title' => $hero_title,
            'style' => 'theme_three',
            'text' => isset($hero_text) && !empty($hero_text) ? $hero_text : '',
            'global_search_form' =>
                '<form class="global-search-form js-global-search-form">' .
                '<p class="blog-landing-form-title">' .
                $form_title .
                '</p>' .
                '<input id="searchBox" type="text" name="s" value="' .
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
        $search_template = new \App\Classes\GlobalSearchTemplate();
        $search_query = $search_template->getSearchQuery();
        $post_types = $search_template->getPostTypes();

        $total_posts = $search_query->found_posts;
        $displayed_posts = $search_query->post_count;
    @endphp

    <div class="blog-landing__search-wrapper" data-page-type="global-search">
        <div class="container">
            <div class="blog-landing__search">
                {{-- Filters Section --}}
                <div class="blog-landing__search__filters-container">
                    <h3 class="blog-landing__search__filters__filter-title blog-landing__search__filters__filter-title--global-search"
                        role="heading">
                        {{ __('Filter By', 'lgfb') }}
                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                    </h3>
                    <div class="blog-landing__search__filters blog-landing__search__filters--global-search">
                        <div
                            class="blog-landing__search__filters__taxonomy blog-landing__search__filters__taxonomy--post-type">
                            @if (!empty($post_types))
                                <ul class="topic-taxonomy__list topic-taxonomy__list--global-search"
                                    style="display: block;">
                                    @foreach ($post_types as $type)
                                        <li>
                                            <label class="filter-checkbox fs-sm">
                                                <input type="checkbox" class="filter-checkbox__input"
                                                    name="post_type_filters[]" value="{{ esc_attr($type['name']) }}">
                                                <span class="filter-checkbox__custom"></span>
                                                {!! $type['label'] !!}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="blog-landing__search__filters__filter-buttons">
                            <a href="" class="btn-lgfb btn-lgfb--medium blog-landing-apply-filter-btn"
                                data-nonce="{{ wp_create_nonce('global_search_nonce') }}"
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

                {{-- Results Section --}}
                <div class="blog-landing__search__results">
                    <p class="blog-landing__search__search-results-info">
                        {{ __('Displaying', 'lgfb') }} <span class="light-medium">{{ $displayed_posts }}
                            {{ __('of', 'lgfb') }} {{ $total_posts }}</span> {{ __('Results', 'lgfb') }}
                    </p>

                    <div class="blog-landing__search__results__posts">
                        @if ($search_query->have_posts())
                            @while ($search_query->have_posts())
                                @php($search_query->the_post())
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
                                                <p class="post-category">
                                                    {{ get_post_type() === 'post' ? 'Blog Post' : get_post_type_object(get_post_type())->labels->singular_name }}
                                                </p>
                                                {{-- <p class="post-date">{{ get_the_date() }}</p> --}}
                                                <h4 class="post-title"> {!! function_exists('relevanssi_highlight_terms')
                                                    ? relevanssi_highlight_terms(get_the_title(), get_search_query())
                                                    : get_the_title() !!}
                                                </h4>
                                                <p> {!! function_exists('relevanssi_highlight_terms')
                                                    ? relevanssi_highlight_terms(wp_trim_words(get_the_excerpt(), 17, '...'), get_search_query())
                                                    : wp_trim_words(get_the_excerpt(), 17, '...') !!}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endwhile
                            @php(wp_reset_postdata())
                        @else
                            <p>{{ __('No blog posts found.', 'lgfb') }}</p>
                        @endif
                    </div>

                    {{-- Pagination --}}
                    <div class="blog-landing__pagination">
                        {!! paginate_links([
                            'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                            'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-landing__inline-form">
        @includeWhen(class_exists(\App\Blocks\InlineForm::class), 'blocks.inline-form', [
            'block' => (object) [
                'block' => (object) ['anchor' => 'inline-form'],
                'classes' => '',
            ],
            'title' => get_field('global_search-inline-form-title', 'options'),
            'intro' => get_field('global_search-inline-form-intro', 'options'),
            'style' => get_field('global_search-inline-form-style', 'options'),
            'form_id' => get_field('global_search-inline-form-form_id', 'options'),
        ])
    </div>
@endsection
