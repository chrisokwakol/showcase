<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Post extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.page-header',
		'partials.content',
		'partials.content-*',
		'partials.hero',
		'partials.hero-*'
	];

	/**
	 * Data to be passed to view before rendering, but after merging.
	 *
	 * @return array
	 */
	public function override()
	{
		return [
			'title' => $this->title(),
			'categories' => $this->getCategories(),
			'author' => get_field('post_author'),
			'date' => $this->getDate()
		];
	}

	/**
	 * Retrieve the post title.
	 *
	 * @return string
	 */
	public function title()
	{

		if ($this->view->name() === 'partials.hero-location' || $this->view->name() === 'partials.hero-practice') {
			$override = get_field('location_title_override');
			return !empty($override) ? $override : get_the_title();
		}

		if ($this->view->name() !== 'partials.page-header') {
			return get_the_title();
		}


		if (is_home()) {
			if ($home = get_option('page_for_posts', true)) {
				return get_the_title($home);
			}

			return __('Latest Posts', 'lgfb');
		}

		if (is_archive()) {
			return get_the_archive_title();
		}

		if (is_search()) {
			return sprintf(
				/* translators: %s is replaced with the search query */
				__('Search Results for %s', 'lgfb'),
				get_search_query()
			);
		}

		if (is_404()) {
			return __('Not Found', 'lgfb');
		}

		return get_the_title();
	}

	public function getCategories()
	{
		$output = [];
		$article_listing = get_permalink(get_option('page_for_posts'));

		$categories = get_the_terms(get_the_ID(), 'category');
		$tags = get_the_terms(get_the_ID(), 'post_tag');

		if (!empty($categories)) {
			foreach ($categories as $cat) {
				$output[] = [
					'url' => "$article_listing?category=$cat->slug",
					'name' => $cat->name
				];
			}
		}

		if (!empty($tags)) {
			foreach ($tags as $tag) {
				$output[] = [
					'url' => "$article_listing?tag=$tag->slug",
					'name' => $tag->name
				];
			}
		}

		return $output;
	}

	public function getDate()
	{
		$date = get_field('post_date');

		if (empty($date)) return;

		$proper_date = date_create($date);
		return [
			'iso' => $date,
			'formatted' => date_format($proper_date, 'F j, Y'),
		];
	}
}
