<footer class="footer">
    <div class="footer__inner container">
        <div class="footer__top d-flex justify-content-center">
            <div class="footer__column column--left d-flex">

                <div class="column__inner footer__details">
                    <div class="details__item footer__logo">
                        @if ($footer_logo)
                            <a class="brand" href="{{ home_url('/') }}" title="{!! $site_name !!}">
                                <x-img :image="$footer_logo" />
                            </a>
                        @endif
                    </div>

                    @if ($contact_information)
                        <div class="details__item details--contact-info fs-base hide-external-icon">
                            <p>{!! $contact_information !!}</p>
                        </div>
                    @endif
                </div>

                <div class="column__inner featured-links-container">
                    <p class="title fs-lg medium">Featured Links</p>
                    @if ($featured_links)
                        <ul class="featured-links">
                            @foreach ($featured_links as $link)
                                <a class="featured-link" href="{{ $link['url'] }}">
                                    <li class="fs-base light">
                                        <span>{{ $link['link_text'] }}</span>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
            <div class="footer__column column--right">

                <div class="column__inner">
                    <div class="ctas">
                        @if ($footer_cta_one)
                            <x-btn :btn="$footer_cta_one" class="bold fs-sm btn-lgfb--dark" />
                        @endif
                        @if ($footer_cta_two)
                            <x-btn :btn="$footer_cta_two" class="bold fs-sm btn-lgfb--dark" />
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="footer__bottom d-flex">
            <div class="footer__social-links">
                    <div class="footer__title fs-base light-medium">{!! $social_media_section_heading !!}</div>
                    @if ($social_media)
                        <ul class="d-flex">
                            @foreach ($social_media as $social_media_link)
                                @if ($social_media_link['url'])
                                    <li class="social-icon">
                                        <a href="{{ $social_media_link['url'] }}"
                                            title="{{ $social_media_link['title'] }}"
                                            @if ($social_media_link['open_in_new_tab']) target="_blank" class="hide-external-icon" @endif>
                                            {!! $social_media_link['icon'] !!}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            <div class="footer__bottom__menu">
                @if ($footer_privacy_policy || $footer_site_map || $footer_charitable_number)
                    <div class="legal-links hide-external-icon">
                        <div class="privacy-policy-site-map">
                            <a href="{{ $footer_privacy_policy['url'] }}" class="privacy-policy fs-sm medium">{{ $footer_privacy_policy['title'] }}</a>
                            <a href="{{ $footer_site_map['url'] }}" class="site-map fs-sm medium">{{ $footer_site_map['title'] }}</a>
                        </div>
                        @if ($footer_charitable_number)
                            <div class="charitable-number">
                                <p class="fs-sm">{{ $footer_charitable_number }}</p>
                            </div>
                        @endif
                        <div class="copyright">
                            @if ($footer_copyright)
                                <p class="fs-sm">&copy; {{ date('Y') }} {{ $footer_copyright }}</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</footer>
