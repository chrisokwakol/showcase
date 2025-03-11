@php
    if (empty($selected_testimonials)) {
        $selected_testimonials = get_posts([
            'post_type' => 'testimonial',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
        ]);
    }

    // Ensure we always work with an array of post objects
    $testimonials = array_map(function ($testimonial) {
        return is_object($testimonial) ? $testimonial : get_post($testimonial);
    }, $selected_testimonials);

    $testimonial_count = count($testimonials);
@endphp

@if (!empty($testimonials) || is_admin())
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="testimonial-carousel {{ $block->classes }}">
        <div class="container testimonial-carousel-container">
            <div class="testimonial-carousel__inner">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @if (!empty($testimonials))
                            @foreach ($testimonials as $testimonial)
                                @php
                                    // Fetch all ACF fields for the testimonial
                                    $fields = get_fields($testimonial->ID);

                                    // Assign individual variables for easy use
                                    $testimonial_description = $fields['testimonial'] ?? '';
                                    $author = $fields['testimonial_author_name'] ?? '';
                                    $image = $fields['testimonial_author_image'] ?? '';
                                    $context = $fields['testimonial_author_context'] ?? '';
                                @endphp
                                <div class="testimonial-carousel__testimonials swiper-slide">
                                    @if ($image)
                                        <div class="image">
                                            <x-img :image="$image" />
                                        </div>
                                    @endif
                                    @if ($testimonial_description || $author || $context)
                                        <div class="info">
                                            <div class="quote-icon"></div>
                                            <h3 class="title light-medium">{{ $testimonial_description }}</h3>
                                            <p class="author bold">{{ $author }}</p>
                                            <p class="byline medium">{{ $context }}</p>  
                                            <div class="swiper-controls">
                                                <div class="swiper-button-prev"></div>
                                                <div class="swiper-pagination bold">
                                                    <span class="swiper-pagination-current"></span>
                                                    " / "
                                                    <span class="swiper-pagination-total"></span>
                                                </div>
                                                <div class="swiper-button-next"></div>
                                            </div> 
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <x-editor-notification :condition="empty($testimonials)" level="info">
                    <h2>Testimonial Carousel</h2>
                    <p>Add some testimonials to this block to get started.</p>
                </x-editor-notification>
            </div>
        </div>
    </section>
@endif
