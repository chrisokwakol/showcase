@php
  function wrap_last_word($string)
  {
      $words = explode(' ', $string);
      $last_word = array_pop($words);
      $string_without_last_word = implode(' ', $words);

      $final_string =
          $string_without_last_word .
          ' <span style="white-space: nowrap;">' .
          $last_word .
          ' <i class="fa-solid fa-arrow-right" style="font-size: 20px;"></i></span>';

      return $final_string;
  }
@endphp


{{-- <x-alert-bar/> --}}
<div class="header__top-trigger"></div>

<header class="header">
  {{-- Top Header Section --}}
  <div class="header__top">
    <div class="container d-flex align-items-center h-100">
      {{-- Logo --}}
      @if ($header_logo)
        <a class="header__logo" href="{{ home_url('/') }}" aria-label="Go to Home">
          <x-img :image="$header_logo" />
        </a>
      @endif

      {{-- Contact and Utility Links --}}
      <div class="header__top__right ml-auto d-flex">
        <div class="header__top__right__contact-language-container">
          {{-- Contact Links --}}
          <div class="header__top__right__contact-links">
            @if ($header_email)
              <div class="header__top__right__contact-links__contact-link">
                <i class="header__top__right__contact-links__icon icon__email"></i>
                <a href="mailto:{{ $header_email }}" target="_blank"
                  class="header__top__right__email bold fs-base">{{ $header_email }}</a>
              </div>
            @endif
            @if ($header_phone)
              <div class="header__top__right__contact-links__contact-link">
                <i class="header__top__right__contact-links__icon icon__phone"></i>
                <a href="tel:{{ $header_phone }}" target="_blank"
                  class="header__top__right__phone bold fs-base">{{ $header_phone }}</a>
              </div>
            @endif
          </div>

          {{-- Language Switcher --}}
          <div class="header__top__right__language-switcher">
            @php
              echo do_shortcode('[custom_language_switcher]');
            @endphp
          </div>
        </div>


        {{-- Utility Links --}}
        <div class="header__top__right__utility__links">
          @if ($header_utility_links)
            @foreach ($header_utility_links as $item)
              <x-btn :btn="$item['link']" class="" />
            @endforeach
          @endif
        </div>

        {{-- Mobile Menu Toggle --}}
        <div class="header__top__right__mobile show-for-mobile">
          <a href="tel:{{ $header_phone }}">
            <i></i>
          </a>
          <button class="header__toggle flex-column align-items-center justify-content-center" aria-label="Open Menu"
            aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- Main Navigation --}}
  <div class="header__bottom">
    <div class="header__bottom__container container">
      @if ($header_main_nav)
        <ul class="header__bottom__nav-menu">
          @foreach ($header_main_nav as $item)
            <li class="header__bottom__nav-menu__nav-item">
              <div class="header__bottom__nav-menu__nav-item__container">
                <span class="menu-title">{{ $item['menu_title'] }}</span>
                <i class="fa-solid fa-chevron-down show-for-desktop"></i>
                <i class="fa-solid fa-arrow-right show-for-mobile"></i>
              </div>

              @if (isset($item['sub-menu_groups']) && is_array($item['sub-menu_groups']))
                <ul class="submenu submenu-desktop">
                  <p class="submenu__go-back-btn fs-base medium show-for-mobile">Go Back</p>
                  @if (isset($item['sub-menu_groups']) && is_array($item['sub-menu_groups']))
                    @foreach ($item['sub-menu_groups'] as $group)
                      @if (isset($group['is_primary']) && $group['is_primary'])
                        {{-- Primary Group --}}
                        <li class="submenu__group submenu__group--primary-group">
                          <a href="{{ $group['primary_group_link'] }}"
                            class="submenu__group-title submenu__group-title--primary-group">
                            <span>
                              {!! wrap_last_word($group['primary_group_text']) !!}
                            </span>
                          </a>
                          <ul class="submenu__links">
                            @if (isset($group['group_links']) && is_array($group['group_links']))
                              @foreach ($group['group_links'] as $links)
                                <li class="submenu__link fs-base medium">
                                  <a
                                    href="{{ $links['link_type'] == 'page' ? $links['page_link'] : $links['url_link'] }}">
                                    {{ $links['link_text'] }}
                                  </a>
                                </li>
                              @endforeach
                            @endif
                          </ul>
                        </li>
                      @else
                        {{-- Other Groups --}}
                        <li class="submenu__group">
                          <span class="submenu__group-title light">{{ $group['group_title'] }}</span>
                          <ul class="submenu__links">
                            @if (isset($group['group_links']) && is_array($group['group_links']))
                              @foreach ($group['group_links'] as $links)
                                <li class="submenu__link fs-base medium">
                                  <a href="{{ $links['link_type'] == 'page' ? $links['page_link'] : $links['url_link'] }}"
                                    class="{{ $links['is_button'] == 'true' ? 'btn-lgfb' : '' }}">
                                    {{ $links['link_text'] }}
                                  </a>
                                </li>
                              @endforeach
                            @endif
                          </ul>
                        </li>
                      @endif
                    @endforeach
                  @endif
                </ul>
              @endif
            </li>
          @endforeach
        </ul>
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="header__bottom__container__search">
          <input type="text" name="s" id="searchBox" placeholder="Search..." class="search-desktop medium">
          <i class="fas fa-search search-icon-desktop"></i>
          <i class="fas fa-times close-icon-desktop"></i>
          <button type="submit" style="display: none;"></button>
        </form>
      @endif
    </div>

    {{-- Mobile Nav --}}
    <div class="header__bottom__container__mobile container">
      <div class="header__bottom__container__mobile__search-lang">
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
          <input type="text" name="s" id="searchBox" placeholder="Search..." class="search-mobile medium">
          <i class="fas fa-search search-icon"></i>
          <button type="submit" style="display: none;"></button>
        </form>
        <div class="language-switcher">
          @php
            echo do_shortcode('[custom_language_switcher]');
          @endphp
        </div>
      </div>
      @if ($header_main_nav)
        <ul class="header__bottom__nav-menu">
          @foreach ($header_main_nav as $item)
            <li class="header__bottom__nav-menu__nav-item medium">
              <span class="menu-title">{{ $item['menu_title'] }}</span>
              <i class="fa-solid fa-chevron-down show-for-desktop"></i>
              <i class="fa-solid fa-arrow-right show-for-mobile"></i>

              @if (isset($item['sub-menu_groups']))
                <ul class="submenu">
                  <p class="submenu__go-back-btn fs-base medium">Go Back</p>
                  @if (isset($item['sub-menu_groups']) && is_array($item['sub-menu_groups']))
                    @foreach ($item['sub-menu_groups'] as $group)
                      @if (isset($group['is_primary']) && $group['is_primary'])
                        {{-- Primary Group --}}
                        <li class="submenu__group submenu__group--primary-group">
                          <a href="{{ $group['primary_group_link'] }}"
                            class="submenu__group-title submenu__group-title--primary-group">
                            <span>{{ $group['primary_group_text'] }}</span>
                          </a>
                          <ul class="submenu__links">
                            @if (isset($group['group_links']) && is_array($group['group_links']))
                              @foreach ($group['group_links'] as $links)
                                <li class="submenu__link fs-base medium">
                                  <a
                                    href="{{ $links['link_type'] == 'page' ? $links['page_link'] : $links['url_link'] }}">
                                    {{ $links['link_text'] }}
                                  </a>
                                </li>
                              @endforeach
                            @endif
                          </ul>
                        </li>
                      @else
                        {{-- Other Groups --}}
                        <li class="submenu__group">
                          <span class="submenu__group-title light">{{ $group['group_title'] }}</span>
                          <ul class="submenu__links">
                            @if (isset($group['group_links']) && is_array($group['group_links']))
                              @foreach ($group['group_links'] as $links)
                                <li class="submenu__link fs-base medium">
                                  <a href="{{ $links['link_type'] == 'page' ? $links['page_link'] : $links['url_link'] }}"
                                    class="{{ $links['is_button'] == 'true' ? 'btn-lgfb' : '' }}">
                                    {{ $links['link_text'] }}
                                  </a>
                                </li>
                              @endforeach
                            @endif
                          </ul>
                        </li>
                      @endif
                    @endforeach
                  @endif
                </ul>
              @endif
            </li>
          @endforeach
        </ul>
      @endif

      {{-- Mobile Utility Links --}}
      <div class="header__bottom__utility__links show-for-mobile">
        @if ($header_utility_links)
          @foreach ($header_utility_links as $item)
            <x-btn :btn="$item['link']" class="" />
          @endforeach
        @endif
      </div>

      {{-- Mobile Contact Links --}}
      <div class="header__bottom__contact-links show-for-mobile">
        @if ($header_email)
          <div class="header__bottom__contact-links__email-container">
            <i class="header__top__right__contact-links__icon icon__email icon__email--mobile"></i>
            <a href="mailto:{{ $header_email }}" target="_blank"
              class="header__top__right__email fs-base bold">{{ $header_email }}</a>
          </div>
        @endif
        @if ($header_phone)
          <div class="header__bottom__contact-links__phone-container">
            <i class="header__top__right__contact-links__icon icon__phone icon__phone--mobile"></i>
            <a href="tel:{{ $header_phone }}" target="_blank"
              class="header__top__right__phone fs-base bold">{{ $header_phone }}</a>
          </div>
        @endif
      </div>
    </div>
  </div>
</header>

{{-- Spacer for layout --}}
{{-- <div class="header__spacer"></div> --}}
