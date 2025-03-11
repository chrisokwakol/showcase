@if ($footer_main != null)
    <ul class="footer-menu footer-menu--top">
        @foreach ($footer_main as $item)
            <li class="navigation--item {{ $item->classes ?? '' }} {{ $item->active ? 'active' : '' }}">
                <a href="{{ $item->url }}">
                    {!! $item->label !!}
                </a>
            </li>
        @endforeach
    </ul>
@endif
