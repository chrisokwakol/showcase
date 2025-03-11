@if (!empty($content))
    <section id="{{ $block->block->anchor ?? $block->block->id }}" class="generic-content {{ $block->classes }}">
        <div class="container">
            <div class="generic-content__inner">

            </div>
        </div>
    </section>
@endif
