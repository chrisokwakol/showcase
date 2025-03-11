<?php

function custom_wpml_language_switcher() {
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );

    if (!empty($languages)) {
        echo '<ul class="custom-language-switcher">';
        foreach ($languages as $lang) {
            $active_class = $lang['active'] ? 'active' : '';
            echo '<li class="' . esc_attr($active_class) . '">';
            echo '<a href="' . esc_url($lang['url']) . '" aria-label="Switch to '.esc_html($lang['native_name']).'">';
                echo esc_html($lang['language_code']) . '</a>';
            echo '</li>';
        }
        echo '</ul>';
    }
}
// Add the language switcher to a shortcode
add_shortcode('custom_language_switcher', 'custom_wpml_language_switcher');
