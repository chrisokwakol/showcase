<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;

class CTAStrip extends Block
{
  /**
   * The block name.
   *
   * @var string
   */
  public $name = 'CTA Strip';

  /**
   * The block description.
   *
   * @var string
   */
  public $description = 'A block that displays a CTA Strip.';

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
  public $icon = 'megaphone';

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
      'title' => get_field('cta-strip_title'),
      'style' => get_field('cta-strip_style'),
      'vertical_padding' => get_field('cta-strip_vertical_padding') ? get_field('cta-strip_vertical_padding') : 'medium',
      'text' => get_field('cta-strip_text'),
      'cta_one' => get_field('cta-strip_cta_one'),
      'cta_two' => get_field('cta-strip_cta_two'),
      'image' => get_field('cta-strip_image'),
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
