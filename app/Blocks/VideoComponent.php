<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;

class VideoComponent extends Block
{
	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $name = 'Video Component';

	/**
	 * The block description.
	 *
	 * @var string
	 */
	public $description = 'A video component with a transcript.';

	/**
	 * The block category.
	 *
	 * @var string
	 */
	public $category = 'lgfb';

	/**
	 * The block icon.
	 *
	 * @var string|array
	 */
	public $icon = 'video-alt3';

	/**
	 * The block keywords.
	 *
	 * @var array
	 */
	public $keywords = ['transcript', 'youtube', 'vimeo'];

	/**
	 * The block post type allow list.
	 *
	 * @var array
	 */
	public $post_types = [];

	/**
	 * The parent block type allow list.
	 *
	 * @var array
	 */
	public $parent = [];

	/**
	 * The ancestor block type allow list.
	 *
	 * @var array
	 */
	public $ancestor = [];

	/**
	 * The default block mode.
	 *
	 * @var string
	 */
	public $mode = 'preview';

	/**
	 * The supported block features.
	 *
	 * @var array
	 */
	public $supports = [
		'align' => false,
		'align_text' => false,
		'align_content' => false,
		'full_height' => false,
		'anchor' => true,
		'mode' => true,
		'multiple' => true,
		'jsx' => true,
		'color' => [
			'background' => false,
			'text' => false,
			'gradient' => false,
		],
	];

	/**
	 * Data to be passed to the block before rendering.
	 *
	 * @return array
	 */
	public function with()
	{
		return [
			'title'    => get_field('lgfb-video_title'),
			'description' => get_field('lgfb-video_intro'),
			'source'   => get_field('lgfb-video_source'),
			'poster'   => get_field('lgfb-video_poster_image'),
			'transcript'   => get_field('lgfb-video_transcript'),
			'style'   => get_field('lgfb-video_style'),
			'bg_image'   => get_field('lgfb-video_background_image'),
		];
	}

	/**
	 * The block field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		return [];
	}
}
