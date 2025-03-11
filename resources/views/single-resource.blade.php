@extends('page')

@section('content')
    @while (have_posts())
        @php
            the_post();
            $back_btn_url = get_field('resource_detail_back-button-url');
            $back_btn_text = get_field('resource_back_button-text');
            $pre_title = get_field('resource_detail_pre-title');
            $title = get_field('resource_detail-title') ? get_field('resource_detail-title') : get_the_title();
            $text = get_field('resource_detail-intro');
            $image = get_the_post_thumbnail_url();
        @endphp


        <section class="resource-detail">
            {{-- Hero --}}
            <section class="simple-hero simple-hero--resource-detail">
                <div class="simple-hero__inner">
                    <div class="simple-hero__container container">
                        <div class="simple-hero__content simple-hero__content--left">
                            <a href="{{ $back_btn_url }}"
                                class="resources-detail__go-back-btn fs-base">{!! $back_btn_text !!}</a>
                            @if ($pre_title)
                                <p class="simple-hero__pre-title">{!! $pre_title !!}</p>
                            @endif
                            @if ($title)
                                <h1 class="simple-hero__title">{!! $title !!}</h1>
                            @endif
                            @if (!empty($image))
                                <img src="{{ $image }}" alt=""
                                    class="simple-hero__image simple-hero__image--mobile show-for-mobile">
                            @endif
                            @if ($text)
                                <p class="simple-hero__text">{!! $text !!}</p>
                            @endif
                        </div>
                        <div class="simple-hero__content simple-hero__content--right">
                            @if (!empty($image))
                                <img src="{{ $image }}" alt=""
                                    class="simple-hero__image simple-hero__image--desktop show-for-desktop">
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </section>
    @endwhile

    @php the_content() @endphp
@endsection
