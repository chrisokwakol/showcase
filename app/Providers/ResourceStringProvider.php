<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use WP_Query;

class ResourceStringProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
	}

	/**
	 * Get the string based on the key, provide a fallback if nothing is returned.
	 *
	 *
	 * @param string $key The key to find the string post. Queries against the title.
	 * @param string $fallback The fallback if now string is found.
	 * @param array $args An array of arguments to facilitate string interpolation
	 *
	 * @returns string
	 */
	public static function get(string $key = '', string $fallback = '', array $args = []): string
	{

		$output = $fallback;

		$query = [
			'post_type' => 'resource_string',
			'post_status' => 'publish',
			'title' => $key,
		];

		$resource_strings = new WP_Query($query);

		if ($resource_strings->have_posts()) {
			while ($resource_strings->have_posts()) {
				$resource_strings->the_post();

				$string_value = get_field('resource_string_value');

				if (!empty($string_value)) {
					$output = $string_value;
				}
			}
		}

		wp_reset_query();
		wp_reset_postdata();

		if (!empty($args)) {
			$output = vsprintf($output, $args);
		}

		return $output;
	}
}
