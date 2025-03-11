<?php
add_action('wp_ajax_filter_blog_posts', 'filter_blog_posts_callback');
add_action('wp_ajax_nopriv_filter_blog_posts', 'filter_blog_posts_callback');
add_action('wp_ajax_filter_global_search', 'filter_global_search_callback');
add_action('wp_ajax_nopriv_filter_global_search', 'filter_global_search_callback');

function filter_blog_posts_callback()
{
  // Verify nonce for blog landing
  if (!wp_verify_nonce($_POST['nonce'], 'blog_landing_nonce')) {
    wp_send_json_error(['message' => 'Invalid nonce.']);
  }

  // Get filters and page number
  $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
  $page = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
  $search_term = isset($_POST['s']) ? sanitize_text_field($_POST['s']) : '';

  // Set up WP_Query arguments
  $args = [
    'post_type' => 'post',
    'posts_per_page' => 10,
    'paged' => $page,
    'post_status' => 'publish',
    'orderby' => $search_term ? 'relevance' : 'date',
    'order' => 'DESC',
    'suppress_filters' => false
  ];

  // Add search if present
  if (!empty($search_term)) {
    $args['s'] = $search_term;
  }

  // Handle taxonomy filters
  if (!empty($filters)) {
    $tax_query = [];

    foreach (['topic', 'treatment-stage', 'audience-type'] as $taxonomy) {
      if (!empty($filters[$taxonomy])) {
        $tax_query[] = [
          'taxonomy' => $taxonomy,
          'field' => 'slug',
          'terms' => (array)$filters[$taxonomy],
          'operator' => 'IN'
        ];
      }
    }

    if (count($tax_query) > 1) {
      $tax_query = array_merge(['relation' => 'AND'], $tax_query);
      $args['tax_query'] = $tax_query;
    } elseif (count($tax_query) === 1) {
      $args['tax_query'] = $tax_query;
    }
  }

  // Add language if WPML is active
  if (defined('ICL_LANGUAGE_CODE')) {
    $args['lang'] = ICL_LANGUAGE_CODE;
  }

  $query = new WP_Query($args);

  if (function_exists('relevanssi_do_query')) {
    relevanssi_do_query($query);
  }

  if ($query->have_posts()) {
    ob_start();
    while ($query->have_posts()) {
      $query->the_post();

      // Special handling for blog posts to get main topic
      $main_topic_name = '';
      $main_topic_id = get_field('blog_detail_main_topic');
      if ($main_topic_id) {
        $main_topic = get_term($main_topic_id);
        $main_topic_name = $main_topic && !is_wp_error($main_topic) ? $main_topic->name : '';
      }
?>
      <div class="blog-landing__search__results__posts__post">
        <a href="<?php echo get_permalink(); ?>" class="blog-landing__search__results__posts__post--link">
          <div class="blog-landing__search__results__posts__post--inner">
            <?php if (has_post_thumbnail()): ?>
              <div class="lgfb-blog-landing-post-thumbnail">
                <?php the_post_thumbnail('thumbnail'); ?>
              </div>
            <?php endif; ?>
            <div class="lgfb-blog-landing-post-content <?php echo !has_post_thumbnail() ? 'no-thumbnail' : ''; ?>">
              <p class="post-category"><?php echo esc_html($main_topic_name); ?></p>
              <p class="post-date"><?php echo get_the_date(); ?></p>
              <h4 class="post-title">
                <?php
                if (function_exists('relevanssi_the_title')) {
                  $highlighted_title = relevanssi_highlight_terms(get_the_title(), $search_term);
                  echo $highlighted_title;
                } else {
                  echo get_the_title();
                }
                ?>
              </h4>
              <p><?php
                  if (function_exists('relevanssi_highlight_terms')) {
                    $excerpt = get_the_excerpt();
                    $trimmed_excerpt = wp_trim_words($excerpt, 17, '...');
                    echo relevanssi_highlight_terms($trimmed_excerpt, $search_term);
                  } else {
                    echo wp_trim_words(get_the_excerpt(), 17, '...');
                  }
                  ?></p>
            </div>
          </div>
        </a>
      </div>
    <?php
    }
    wp_reset_postdata();

    $posts_html = ob_get_clean();

    // Generate pagination
    $pagination_html = paginate_links([
      'total' => $query->max_num_pages,
      'current' => $page,
      'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
      'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
      'type' => 'plain'
    ]);

    wp_send_json_success([
      'posts' => $posts_html,
      'pagination' => $pagination_html,
      'total_posts' => $query->found_posts,
      'displayed_posts' => $query->post_count,
      'current_page' => $page,
      'max_pages' => $query->max_num_pages
    ]);
  } else {
    wp_send_json_error([
      'message' => 'No posts found matching your criteria.',
      'total_posts' => 0,
      'displayed_posts' => 0
    ]);
  }
}

function filter_global_search_callback()
{
  // Verify nonce for global search
  if (!wp_verify_nonce($_POST['nonce'], 'global_search_nonce')) {
    wp_send_json_error(['message' => 'Invalid nonce.']);
  }

  // Get filters and page number
  $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
  $page = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
  $search_term = isset($_POST['s']) ? sanitize_text_field($_POST['s']) : '';

  // Set up WP_Query arguments
  $args = [
    'posts_per_page' => 10,
    'paged' => $page,
    'post_status' => 'publish',
    'orderby' => array( 'post_type' => 'asc', 'relevanssi' => 'desc' ),
    'suppress_filters' => false
  ];

  // Set post types based on filters
  if (!empty($filters) && isset($filters['post_type'])) {
    $args['post_type'] = (array)$filters['post_type'];
  } else {
    $args['post_type'] = [
      'post',
      'page',
      'workshop',
      'resource'
    ];
  }

  // Add search if present
  if (!empty($search_term)) {
    $args['s'] = $search_term;
  }

  // Handle taxonomy filters
  if (!empty($filters)) {
    $tax_query = [];

    foreach (['topic', 'treatment-stage', 'audience-type'] as $taxonomy) {
      if (!empty($filters[$taxonomy])) {
        $tax_query[] = [
          'taxonomy' => $taxonomy,
          'field' => 'slug',
          'terms' => (array)$filters[$taxonomy],
          'operator' => 'IN'
        ];
      }
    }

    if (count($tax_query) > 1) {
      $tax_query = array_merge(['relation' => 'AND'], $tax_query);
      $args['tax_query'] = $tax_query;
    } elseif (count($tax_query) === 1) {
      $args['tax_query'] = $tax_query;
    }
  }

  // Add language if WPML is active
  if (defined('ICL_LANGUAGE_CODE')) {
    $args['lang'] = ICL_LANGUAGE_CODE;
  }

  $query = new WP_Query($args);

  if (function_exists('relevanssi_do_query')) {
    relevanssi_do_query($query);
  }

  if ($query->have_posts()) {
    ob_start();
    while ($query->have_posts()) {
      $query->the_post();

      // Determine the post type label
      $post_type = get_post_type();
      $post_type_label = ($post_type === 'post') ? 'Blog Post' : get_post_type_object($post_type)->labels->singular_name;

    ?>
      <div class="blog-landing__search__results__posts__post">
        <a href="<?php echo get_permalink(); ?>" class="blog-landing__search__results__posts__post--link">
          <div class="blog-landing__search__results__posts__post--inner">
            <?php if (has_post_thumbnail()): ?>
              <div class="lgfb-blog-landing-post-thumbnail">
                <?php the_post_thumbnail('thumbnail'); ?>
              </div>
            <?php endif; ?>
            <div class="lgfb-blog-landing-post-content <?php echo !has_post_thumbnail() ? 'no-thumbnail' : ''; ?>">
              <p class="post-category">
                <?php
                echo esc_html($post_type_label);
                ?>
              </p>
              <h4 class="post-title">
                <?php
                if (function_exists('relevanssi_the_title')) {
                  $highlighted_title = relevanssi_highlight_terms(get_the_title(), $search_term);
                  echo $highlighted_title;
                } else {
                  echo get_the_title();
                }
                ?>
              </h4>
              <p><?php
                  if (function_exists('relevanssi_highlight_terms')) {
                    $excerpt = get_the_excerpt();
                    $trimmed_excerpt = wp_trim_words($excerpt, 47, '...');
                    echo relevanssi_highlight_terms($trimmed_excerpt, $search_term);
                  } else {
                    echo wp_trim_words(get_the_excerpt(), 47, '...');
                  }
                  ?></p>
            </div>
          </div>
        </a>
      </div>
<?php
    }
    wp_reset_postdata();

    $posts_html = ob_get_clean();

    // Generate pagination
    $pagination_html = paginate_links([
      'total' => $query->max_num_pages,
      'current' => $page,
      'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
      'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
      'type' => 'plain'
    ]);

    wp_send_json_success([
      'posts' => $posts_html,
      'pagination' => $pagination_html,
      'total_posts' => $query->found_posts,
      'displayed_posts' => $query->post_count,
      'current_page' => $page,
      'max_pages' => $query->max_num_pages
    ]);
  } else {
    wp_send_json_error([
      'message' => 'No results found matching your criteria.',
      'total_posts' => 0,
      'displayed_posts' => 0
    ]);
  }
}

?>
