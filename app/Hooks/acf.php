<?php

use App\Providers\AdminNotice;

// Set save point
add_filter('acf/settings/save_json', function ($path) {
	$path = get_stylesheet_directory() . '/resources/acf-json';
	return $path;
});

// Set load point(s) - ACF loads all.json files from multiple load points
add_filter('acf/settings/load_json', function ($paths) {
	// remove original path (optional)
	unset($paths[0]);
	// append path
	$paths[] = get_stylesheet_directory() . '/resources/acf-json';
	return $paths;
});

// Register Google Maps API Key
function my_acf_init()
{
	$google_api_key = get_field('google_maps_api', 'options');

	if ($google_api_key) {
		acf_update_setting('google_api_key', $google_api_key);
	}
}
add_action('acf/init', 'my_acf_init');

// Fix ACF not validating Gutenberg required fields in blocks
add_action( 'acf/validate_save_post', '_validate_save_post', 5 );
function _validate_save_post() {

    // bail early if no $_POST
    $acf = false;
    foreach($_POST as $key => $value) {
        if (strpos($key, 'acf') === 0) {
            if (! empty( $_POST[$key] ) ) {
                acf_validate_values( $_POST[$key], $key);
            }
        }
    }
}
