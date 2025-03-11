@props([
    'condition' => true,
    'level' => 'info', // info, success, warning, error
])

@if (is_admin() && $condition)
    @php
        $icon = '';
        switch ($level) {
            case 'info':
                $icon = 'circle-info';
                break;

            case 'success':
                $icon = 'circle-check';
                break;

            case 'warning':
                $icon = 'circle-exclamation';
                break;

            case 'error':
                $icon = 'circle-x';
                break;
        }
    @endphp

    <div class="editor-notification editor-notification--{{ $level }}">
        <div class="editor-notification__icon">
            <i class="fa-solid fa-{{ $icon }}"></i>
        </div>
        <div class="editor-notification__content">
            {{ $slot }}
        </div>
    </div>
@endif
