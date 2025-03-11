<!doctype html>
<html @php(language_attributes())>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())
    @if($head_code)
        {!! $head_code !!}
    @endif
</head>

<body @php(body_class())>
    @if($body_code)
      {!! $body_code !!}
    @endif
    @php(wp_body_open())

    <a class="skip-to-content btn-emerson btn-emerson--green btn-emerson--large" href="#main">
        {{ __('Skip to content') }}
    </a>

    @include('sections.header')

    <main id="main" class="main">
        <article @php(post_class())>
            @yield('hero')
            @yield('content')
        </article>
    </main>

    @hasSection('sidebar')
        <aside class="sidebar">
            @yield('sidebar')
        </aside>
    @endif

    <x-back-to-top />

    @include('sections.footer')

    @php(do_action('get_footer'))
    @php(wp_footer())
</body>

</html>
