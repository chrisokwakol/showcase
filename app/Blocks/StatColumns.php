<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;

class StatColumns extends Block
{
  /**
   * The block name.
   *
   * @var string
   */
  public $name = 'Stat Columns';

  /**
   * The block description.
   *
   * @var string
   */
  public $description = 'A simple block showing Statistics.';

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
  public $icon = 'chart-line';

  /**
   * The block keywords.
   *
   * @var array
   */
  public $keywords = ['numbers'];

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
      'title' => get_field('stat_columns_title'),
      'text' => get_field('stat_columns_text'),
      'cta' => get_field('stat_columns_cta'),
      'stats' => get_field('stat_columns_stats'),
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
