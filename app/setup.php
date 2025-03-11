<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

use App\Providers\AdminNoticeProvider;
use App\View\Composers\Navigation as ComposersNavigation;
use App\View\Navigation;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
	bundle('app')->enqueue();
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', [], null);
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
	bundle('editor')->enqueue();
}, 100);

/**
 * Register the theme assets with the admin panel.
 *
 * @return void
 */
add_action('admin_enqueue_scripts', function () {
	bundle('admin')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
	/**
	 * Disable full-site editing support.
	 *
	 * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
	 */
	remove_theme_support('block-templates');

	/**
	 * Register the navigation menus.
	 *
	 * When registering a new navigation, make sure to add the id to the Navigation Composer Class
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 * @uses Navigation static props
	 */
	$navigation = new ComposersNavigation();
	register_nav_menus([
		$navigation->primary_id => __('Primary Navigation', 'sprout'),
		$navigation->utility_id => __('Utility Navigation', 'sprout'),
		$navigation->footer_main_id	=> __('Footer Main', 'sprout'),
		$navigation->footer_utility_id	=> __('Footer Utility', 'sprout'),
		$navigation->footer_bottom_id	=> __('Footer Bottom', 'sprout'),
	]);

	/**
	 * Disable the default block patterns.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
	 */
	remove_theme_support('core-block-patterns');

	/**
	 * Enable plugins to manage the document title.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
	 */
	add_theme_support('title-tag');

	/**
	 * Enable post thumbnail support.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Enable responsive embed support.
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
	 */
	add_theme_support('responsive-embeds');

	/**
	 * Enable HTML5 markup support.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	 */
	add_theme_support('html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
		'script',
		'style',
	]);

	/**
	 * Remove custom colors
	 */

	add_theme_support('disable-custom-colors');

	/**
	 * Enable selective refresh for widgets in customizer.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
	 */
	add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
	$config = [
		'before_widget' 	=> '<section class="widget %1$s %2$s">',
		'after_widget' 		=> '</section>',
		'before_title' 		=> '<h3>',
		'after_title' 		=> '</h3>',
	];

	register_sidebar([
		'name' 	=> __('Primary', 'sprout'),
		'id' 		=> 'sidebar-primary',
	] + $config);

	register_sidebar([
		'name' 	=> __('Footer', 'sprout'),
		'id' 		=> 'sidebar-footer',
	] + $config);
});
