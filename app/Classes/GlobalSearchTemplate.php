<?php

namespace App\Classes;

use WP_Query;

class GlobalSearchTemplate
{
  protected $post_types = [];
  protected $posts_per_page = 10;
  protected $search_query;

  public function __construct()
  {
    $this->post_types = ['post', 'page', 'workshop', 'resource'];
  }

  public function getSearchQuery()
  {
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $search_term = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    $query = new WP_Query([
      'post_type' => $this->post_types,
      'posts_per_page' => $this->posts_per_page,
      'paged' => $paged,
      'orderby' => array( 'post_type' => 'asc', 'relevanssi' => 'desc' ),
      's' => $search_term,
    ]);

    if (function_exists('relevanssi_do_query') && !empty($search_term)) {
      relevanssi_do_query($query);
    }

    return $query;
  }

  public function getPostTypes()
  {
    $allowed_types = [
      'post' => 'Blog Post',
      'page' => 'Page',
      'workshop' => 'Workshop',
      'resource' => 'Resource'
    ];

    $filtered_types = [];

    foreach ($allowed_types as $type => $label) {
      if (post_type_exists($type)) {
        $filtered_types[] = [
          'name' => $type,
          'label' => $label,
        ];
      }
    }

    return $filtered_types;
  }
}
