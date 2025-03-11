<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;

class Accordion extends Block
{
	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $name = 'Accordion';

	/**
	 * The block description.
	 *
	 * @var string
	 */
	public $description = 'A simple Accordion block.';

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
	public $icon = 'table-col-before';

	/**
	 * The block keywords.
	 *
	 * @var array
	 */
	public $keywords = [];

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
			'accordions' => get_field('accordions_block-accordions'),
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
