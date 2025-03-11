<article class="blog-detail" @php post_class() @endphp>
    @php
        $post = get_post();
        $post_object = get_post($post);
        $post_content = get_the_content($post);
        $post_image = get_the_post_thumbnail($post, 'large');
        $post_link = get_the_permalink();
        $main_topic_id = get_field('blog_detail_main_topic');
    @endphp

    <header class="blog-detail__header">
        <div class="container">
            <div class="left">
                @php
                    if ($main_topic_id) {
                        $main_topic = get_term($main_topic_id);
                        $main_topic_name = $main_topic ? $main_topic->name : '';
                    } else {
                        $main_topic_name = '';
                    }
                @endphp

                <p class="category fs-base bold">
                    {!! $main_topic_name !!}
                </p>
                <h1 class="entry-title">{{ get_the_title() }}</h1>
                <p class="author">
                    <span class="light fs-base">Written by:</span>
                    <span class="author-name bold">{{ get_the_author() }}</span>
                </p>
                <div class="topics">
                    @php
                        $taxonomies = [];
                        $all_taxonomies = get_post_taxonomies(get_the_ID());

                        foreach ($all_taxonomies as $taxonomy) {
                            if ($taxonomy === 'category') {
                                continue;
                            }

                            $terms = get_the_terms(get_the_ID(), $taxonomy);
                            if ($terms && !is_wp_error($terms)) {
                                $taxonomies = array_merge($taxonomies, $terms);
                            }
                        }

                        // Exclude terms with the name "Uncategorized"
                        $taxonomies = array_filter($taxonomies, function ($taxonomy) {
                            return $taxonomy->name !== 'Uncategorized';
                        });
                    @endphp
                    @if (!empty($taxonomies))
                        @foreach ($taxonomies as $taxonomy)
                            <p class="topic bold fs-base">{!! $taxonomy->name !!}@if (!$loop->last)
                                @endif
                            </p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="right">
                <img src="{{ get_the_post_thumbnail_url(get_the_ID(), 'full') }}" alt="">
            </div>
        </div>
    </header>

    <div class="blog-detail__middle">
        <p class="blog-detail__middle__date fs-base medium">{{ get_the_date() }}</p>
        {!! the_content() !!}
    </div>

    <div class="blog-detail__bottom">
        <div class="blog-detail__bottom__container is-style-narrow">
            <div class="post__share">
                @include('partials.components.share-icons', ['post_link' => $post_link])
            </div>

            {{-- Navigation Desktop --}}
            <div class="blog-detail__bottom__post-navigation blog-detail__bottom__post-navigation--desktop">
                @if (get_previous_post())
                    <a href="{{ get_permalink(get_previous_post()) }}"
                        class="blog-detail__bottom__post-navigation__previous-post">
                        <p class="blog-detail__bottom__post-navigation__previous-post__prev-post-button bold fs-base">
                            Previous Post</p>
                        <hr>
                        <p class="blog-detail__bottom__post-navigation__previous-post__prev-post-title">
                            {!! get_the_title(get_previous_post()) !!}
                        </p>
                    </a>
                @endif

                @if (get_next_post())
                    <a href="{{ get_permalink(get_next_post()) }}"
                        class="blog-detail__bottom__post-navigation__next-post">
                        <p class="blog-detail__bottom__post-navigation__next-post__next-post-button bold fs-base">Next
                            Post</p>
                        <hr>
                        <p class="blog-detail__bottom__post-navigation__next-post__next-post-title">
                            {!! get_the_title(get_next_post()) !!}
                        </p>
                    </a>
                @endif
            </div>

            {{-- Navigation Mobile --}}
            <div class="blog-detail__bottom__post-navigation blog-detail__bottom__post-navigation--mobile">
                @if (get_previous_post())
                    <a href="{{ get_permalink(get_previous_post()) }}"
                        class="btn-lgfb blog-detail__bottom__post-navigation__previous-post">
                        <p class="blog-detail__bottom__post-navigation__previous-post__prev-post-button">Previous</p>
                    </a>
                @endif

                @if (get_next_post())
                    <a href="{{ get_permalink(get_next_post()) }}"
                        class=" btn-lgfb blog-detail__bottom__post-navigation__next-post">
                        <p class="blog-detail__bottom__post-navigation__next-post__next-post-button">Next</p>
                    </a>
                @endif
            </div>
        </div>
    </div>
    @if (get_next_post())
        <a href="{{ get_permalink(get_next_post()) }}"
            class=" btn-lgfb blog-detail__bottom__post-navigation__next-post">
            <p class="blog-detail__bottom__post-navigation__next-post__next-post-button">Next</p>
        </a>
    @endif
    </div>
    </div>
    </div>
    @php
        $blog_detail_title = get_field('blog-detail_related_section-title', 'options');
        $blog_detail_cta_text = get_field('blog-detail_related_section-cta-text', 'options');
        $blog_detail_link = get_field('blog-detail_related_section_cta-link', 'options');
        $blog_detail_related_section_bg = get_field('blog-detail_related_section_bg-color', 'options');

        $related_section_taxonomies = get_the_taxonomies(get_the_ID());
        $taxonomy_terms = [];
        foreach ($related_section_taxonomies as $taxonomy => $terms) {
            $terms = get_the_terms(get_the_ID(), $taxonomy);
            if ($terms) {
                foreach ($terms as $term) {
                    $taxonomy_terms[] = $taxonomy . '_' . $term->slug;
                }
            }
        }
        $has_related_posts = !empty($taxonomy_terms);
    @endphp


    @if ($has_related_posts)
        <div class="blog-detail__routing-cards">
            @includeWhen(class_exists(\App\Blocks\RoutingCards::class), 'blocks.routing-cards', [
                'block' => (object) [
                    'block' => (object) ['anchor' => 'routing-cards'],
                    'classes' => 'custom-routing-cards-class',
                ],
                'title' => $blog_detail_title,
                'source' => 'auto',
                'manual_entries' => [],
                'is_active' => true,
                'post_type' => ['post', 'resource'],
                'taxonomies' => $taxonomy_terms,
                'cta' => [
                    'text' => $blog_detail_cta_text,
                    'link_type' => 'internal',
                    'internal_link' => $blog_detail_link,
                    'external_link' => '',
                    'external_link_new-tab' => '',
                    'file_link' => '',
                    'style' => '',
                    'modal_link' => null,
                    'free_link' => '',
                    'size' => 'medium',
                    'btn_icon' => '<i class="fa-solid fa-arrow-right"></i>',
                ],
                'style' => $blog_detail_related_section_bg,
            ])
        </div>
    @endif
</article>
