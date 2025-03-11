@props([
    'navigation' => null,
    'class' => '',
])

@if ($navigation !== null && Arr::accessible($navigation))
    <ul {{ $attributes->merge(['class' => "navigation {$class}"]) }}>
        @foreach ($navigation as $item)
            <li class="navigation__item {{ $item->classes ?? '' }} {{ $item->active ? 'active' : '' }}">
                <a href="{{ $item->url }}">
                    {!! $item->label !!}
                </a>

                @if ($item->children)
                    <ul class="navigation__subnav">
                        @foreach ($item->children as $child)
                            <li
                                class="navigation__subnav__item {{ $child->classes ?? '' }} {{ $child->active ? 'active' : '' }}">
                                <a href="{{ $child->url }}">
                                    {!! $child->label !!}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
@endif
