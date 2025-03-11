<?php
add_action('wp_ajax_filter_journey_strip', 'handle_journey_strip_ajax');
add_action('wp_ajax_nopriv_filter_journey_strip', 'handle_journey_strip_ajax');

function handle_journey_strip_ajax()
{
  // Validate the nonce
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'journey_strip_nonce')) {
    wp_send_json_error(['message' => 'Invalid nonce'], 400); // 400 Bad Request
    wp_die();
  }

  // Get and sanitize input data
  $stage = isset($_POST['stage']) ? intval($_POST['stage']) : 0;
  $topic = isset($_POST['topic']) ? intval($_POST['topic']) : 0;

  error_log('Stage: ' . $stage . ' Topic: ' . $topic);

  if (empty($stage) || empty($topic)) {
    wp_send_json_error(['message' => 'Missing required parameters'], 400);
    wp_die();
  }

  // Query posts/workshops/resources tagged with both terms
  $args = [
    'post_type' => ['post', 'workshop', 'resource'],
    'tax_query' => [
      'relation' => 'AND',
      [
        'taxonomy' => 'treatment-stage',
        'field' => 'term_id',
        'terms' => $stage,
      ],
      [
        'taxonomy' => 'topic',
        'field' => 'term_id',
        'terms' => $topic,
      ],
    ],
  ];


  $query = new WP_Query($args);

  // Prepare the response
  if ($query->have_posts()) {
    $results = [];
    while ($query->have_posts()) {
      $query->the_post();
      $results[] = [
        'title' => get_the_title(),
        'url' => get_permalink(),
        'post_type' => get_post_type()
      ];
    }
    wp_reset_postdata();

    wp_send_json_success(['results' => $results]);
  } else {
    wp_send_json_success(['results' => []]); // No results found
  }

  wp_die();
}
