<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Breadcrumbs extends Composer
{

	protected static $views = [
		'components.breadcrumbs',
	];

	public function with()
	{
		global $post;

		if (is_null($post) || is_admin()) return;

		// first check if post exists
		$hide_crumbs = get_field('hide_breadcrumbs', $post->ID); // get the option for current page to hide breadcrumb
		if ($hide_crumbs) return;

		$ancestors = get_post_ancestors($post->ID); // get ancestors of current post
		$level = count($ancestors) + 1; // determine level
		$post_type = get_post_type_object(get_post_type()); // Get the post type object
		// determine if we should show crumbs
		$show_crumbs = ($level > 1 || $post_type->name !== 'page') && !is_front_page() && !is_search() && !is_404();

		if (!$show_crumbs) return;

		// create crumbs wrapper
		$breadcrumb = '<nav class="lgfb-breadcrumbs" data-level="' . $level . '">';
		// always add Home link first
		$breadcrumb .= '<a href="' . home_url() . '">' . __('Home') . '</a>';

		if ($level >= 3) {
			// if we are 3 or more levels deep, add ... to represent middle pages
			$breadcrumb .= ' / <span>...</span>';
		}

		if ($level >= 2) {
			// if we are 2 or more levels deep, add the link to the parent page
			$parent = get_post_parent();
			$breadcrumb .= ' / <a href="' . get_the_permalink($parent) . '">' . $this->trimTitle(get_the_title($parent)) . '</a>';
		}

		if (is_singular() || is_admin()) {

			$page_title = $this->trimTitle(get_the_title($post->ID));
			// Check if it's a custom post type
			if ($post_type->name !== 'post' && $post_type->name !== 'page') {
				// TODO: Omitting the below for now until we determine how to do custom post type "Archive" pages
				// $breadcrumb .= ' / <a href="' . get_post_type_archive_link($post_type->name) . '">' . $post_type->label . '</a>';
				$breadcrumb .= ' / ' . $page_title;
			} else {
				if (is_single()) {
					$article_listing_id = get_option('page_for_posts');
					$breadcrumb .= ' / <a href="' . get_permalink($article_listing_id) . '">' . get_the_title($article_listing_id) . '</a>';
					$breadcrumb .= ' / ' . $page_title;
				} else {
					$breadcrumb .= ' / ' . $page_title;
				}
			}
		}

		if (is_tax() || is_category() || is_tag()) {
			$term = get_queried_object();
			$breadcrumb .= ' / ' . $term->name;
		}

		$breadcrumb .= '</nav>';

		return [
			'breadcrumb' => $breadcrumb,
		];
	}

	public function trimTitle($string, $length = 32)
	{

		if (strlen($string) <= $length) {
			return $string;
		}

		$trimmed = substr($string, 0, $length);

		// If the trimmed string ends in the middle of a word, remove the partial word
		if (substr($string, $length, 1) !== ' ' && strrpos($trimmed, ' ') !== false) {
			$trimmed = substr($trimmed, 0, strrpos($trimmed, ' '));
		}

		return $trimmed . '...';
	}
}
