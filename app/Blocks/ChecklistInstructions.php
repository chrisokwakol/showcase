<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;

class CheckListInstructions extends Block
{
  /**
   * The block name.
   *
   * @var string
   */
  public $name = 'Checklist Instructions';

  /**
   * The block description.
   *
   * @var string
   */
  public $description = 'A block that displays a Checklist Instructions.';

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
  public $icon = 'yes';

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
      'title' => get_field('checklist-instructions_title'),
      'intro' => get_field('checklist-instructions_intro'),
      'list' => get_field('checklist-instructions_list'),
      'show_tip_bottom' => get_field('checklist-instructions_useful_tip_style'),
      'tip_right' => get_field('checklist-instructions_useful_tip_one'),
      'tip_bottom' => get_field('checklist-instructions_useful_tip_two'),
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
