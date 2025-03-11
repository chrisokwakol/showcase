@if (!empty($title))
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="checklist-instructions {{ $block->classes }}">
        <div class="checklist-instructions__container container">
            <div class="checklist-instructions__top">
                <div class="checklist-instructions__top--left">
                    @if ($title)
                        <h2 class="checklist-instructions__title">{{ $title }}</h2>
                    @endif
                    @if ($intro)
                        {{-- {!! $intro !!} --}}
                        <div class="checklist-instructions__intro medium">{!! $intro !!}</div>
                    @endif
                    @if ($list)
                        @foreach ($list as $item)
                            <div class="checklist-instructions__list">
                                {!! $item['check_mark'] !!}
                                <p class="checklist-instructions__list__instruction-text fs-lg medium">
                                    {{ $item['instruction'] }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if (!$show_tip_bottom == 'false' && $tip_right)
                    <div class="checklist-instructions__top--right">
                        @foreach ($tip_right as $item)
                            {!! $item['icon'] !!}
                            <p class="ci-banner-title fs-3xl light-medium">{{ $item['title'] }}</p>
                            <p class="ci-banner-text fs-lg">{{ $item['text'] }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            @if ($show_tip_bottom && $tip_bottom)
                <div class="checklist-instructions__bottom">
                    <div class="checklist-instructions__bottom__container">
                        @foreach ($tip_bottom as $item)
                            {!! $item['icon'] !!}
                            <p class="ci-banner-title fs-3xl light-medium">{{ $item['title'] }}</p>
                            <p class="ci-banner-text fs-lg">{{ $item['text'] }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endif
