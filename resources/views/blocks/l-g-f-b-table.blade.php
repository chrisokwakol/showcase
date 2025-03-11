@if (!empty($title))
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="lgfb-table {{ $block->classes }}">
        <div class="container">
            <div class="lgfb-table__inner">
              @if ($title)
                  <h2 class="lgfb-table__title">{{ $title }}</h2>
              @endif
              @if ($text)
                  <p class="lgfb-table__intro medium fs-base">{{ $text }}</p>
              @endif
            </div>
            <div>
              @if (!empty($table))
                <table class="lgfb-table__table">
                    @if (!empty($table['caption']))
                        <caption>{{ $table['caption'] }}</caption>
                    @endif

                    @if (!empty($table['header']))
                        <thead>
                            <tr>
                                @foreach ($table['header'] as $th)
                                    <th>{!! $th['c'] !!}</th>
                                @endforeach
                            </tr>
                        </thead>
                    @endif

                    <tbody>
                        @foreach ($table['body'] as $tr)
                            <tr>
                                @foreach ($tr as $index => $td)
                                    <td data-label="{{ strip_tags($table['header'][$index]['c'] ?? '') }}">{!! $td['c'] !!}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            </div>
        </div>
    </section>
@endif
