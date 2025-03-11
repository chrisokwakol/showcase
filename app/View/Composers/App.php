<?php

namespace App\View\Composers;

// use App\Providers\AutocompleteServiceProvider;
// use App\Providers\UrlParamProvider;
use Roots\Acorn\View\Composer;

class App extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'*',
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with(): array
	{

		return [
			'site_name' => get_bloginfo('name', 'display'),
			'global_default_image' => get_field('global_default_image', 'options'),

			// Header
			'header_logo' => get_field('header_logo', 'options'),
			'header_email' => get_field('header_email', 'options'),
			'header_phone' => get_field('header_phone', 'options'),
			'header_utility_links' => get_field('header_utility_links', 'options'),
			'header_main_nav' => get_field('header_main-nav', 'options'),
			// 'global_autocomplete' => [
			// 	'useConfig' => 'global',
			// 	'isInHeader' => true,
			// 	'showAllResultsButton' => true,
			// 	'defaultValue' => UrlParamProvider::get('keyword'),
			// 	'layoutConfig' => AutocompleteServiceProvider::getConfig('global'),
			// 	'allResultsUrl' => AutocompleteServiceProvider::getAllResultsUrl('global'),
			// ],

			'resources_hub_page' => get_field('resources_hub_page', 'options'),

			// Footer
			'footer_logo' => get_field('footer_logo', 'options'),
			'contact_information' => get_field('footer_contact_information', 'options'),
			'featured_links' => get_field('footer_featured_links', 'options'),
			'footer_cta_one' => get_field('footer-cta_one', 'options'),
			'footer_cta_two' => get_field('footer-cta_two', 'options'),
			'footer_charitable_number' => get_field('footer-charitable_number', 'options'),
			'footer_copyright' => get_field('footer-copyright', 'options'),
			'footer_privacy_policy' => get_field('footer-privacy_policy', 'options'),
			'footer_site_map' => get_field('footer-site_map', 'options'),

			// Analytics Code
			'head_code' => get_field('head_code', 'options'),
			'body_code' => get_field('body_code', 'options'),

			// Social Media
			'social_media_section_heading' => get_field('social_media_section_heading', 'options'),
			'social_media' => get_field('social-media_links', 'options'),

			//Social Share
			'share_linkedin' => get_field('social-share_linkedin', 'options'),
			'share_facebook' => get_field('social-share_facebook', 'options'),
			'share_email' => get_field('social-share_email', 'options'),
			'share_link' => get_field('social-share_link', 'options'),

			// Listing Page references
			'listing_pages' => [
				'location' => get_field('listing_pages__location', 'options'),
				'practice' => get_field('listing_pages__practice', 'options'),
				'provider' => get_field('listing_pages__provider', 'options'),
				'service' => get_field('listing_pages__service', 'options'),
				'specialty' => get_field('listing_pages__specialty', 'options'),
			],


		];
	}
}
