<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Adds excerpt support for pages.
 *
 * @return null
 */
add_action('init', function () {
	add_post_type_support('page', 'excerpt');
});

// Hook into Relevanssi to include Main Topic Post ACF fields in search
add_filter('relevanssi_content_to_index', __NAMESPACE__ . '\\add_acf_fields_to_relevanssi', 10, 2);
function add_acf_fields_to_relevanssi($content, $post_id)
{
	// Get the main topic term
	$main_topic_id = get_field('blog_detail_main_topic', $post_id);
	if ($main_topic_id) {
		$main_topic = get_term($main_topic_id);
		if ($main_topic && !is_wp_error($main_topic)) {
			// Add the topic name to the content being indexed
			$content .= ' ' . $main_topic->name;
		}
	}

	return $content;
}

// Style WYSIWYG Editor Buttons in Admin Area
add_action('acf/input/admin_footer', function () {
?>
	<script type="text/javascript">
		(function($) {
			acf.add_filter('wysiwyg_tinymce_settings', function(settings, id) {
				settings.toolbar = settings.toolbar || settings.theme_advanced_buttons1;

				var custom_styles = `
                    :root {
                        --ff-open-sans: 'Open Sans', sans-serif;
                        --theme--hibiscus: #a42b5f;
                        --theme--hibiscus-dark-2: #3c0e22;
                        --theme--onyx: #2e3c41;
                        --neutral--50: #ffffff;
                        --neutral--500: #828282;
                    }

                    a.btn-lgfb {
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        border-radius: 12px !important;
                        cursor: pointer !important;
                        text-decoration: none !important;
                        transition: 0.3s ease !important;
                        font-family: var(--ff-open-sans) !important;
                        font-weight: 700 !important;
                        font-size: 16px !important;
                        line-height: 23.04px !important;
                        background-color: var(--theme--hibiscus) !important;
                        color: white !important;
                    }

                    a.btn-lgfb i {
                        color: var(--neutral--50) !important;
                        font-size: 18px !important;
                        margin-left: 8px !important;
                        transition: 0.3s ease !important;
                    }

										a.btn-lgfb.btn-lgfb--medium {
                        min-width: 101px !important;
                        height: 51px !important;
                        padding: 12.5px 21px !important;
                    }

                    a.btn-lgfb:hover,
                    a.btn-lgfb:focus {
                        background-color: var(--theme--hibiscus-dark-2) !important;
                        color: white !important;
                        text-decoration: none !important;
                    }

                    a.btn-lgfb:hover i,
                    a.btn-lgfb:focus i {
                        color: var(--neutral--50) !important;
                    }

                    a.btn-lgfb.btn-lgfb--rich-text {
                        height: auto !important;
                        display: inline-block !important;
                        text-align: center !important;
                        font-size: 14px !important;
                        min-width: fit-content !important;
                        margin-right: 4px !important;
                        margin-left: 4px !important;
                    }

                    a.btn-lgfb.btn-lgfb--dark {
                        background-color: var(--theme--hibiscus-dark-2) !important;
                        color: var(--neutral--50) !important;
                    }

                    a.btn-lgfb.btn-lgfb--dark:hover,
                    a.btn-lgfb.btn-lgfb--dark:focus {
                        color: var(--neutral--50) !important;
                        background-color: var(--theme--hibiscus) !important;
                    }

                    a.btn-lgfb.btn-lgfb--outline {
                        border: 1px solid var(--theme--hibiscus) !important;
                        background-color: white !important;
                        color: var(--theme--onyx) !important;
                    }

                    a.btn-lgfb.btn-lgfb--outline:hover,
                    a.btn-lgfb.btn-lgfb--outline:focus {
                        color: var(--neutral--50) !important;
                        border: 1px solid transparent !important;
                        background-color: var(--theme--hibiscus) !important;
                    }
                `;

				if (settings.content_style) {
					settings.content_style += custom_styles;
				} else {
					settings.content_style = custom_styles;
				}

				return settings;
			});
		})(jQuery);
	</script>
<?php
});

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
	return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'lgfb'));
});

add_filter('block_categories_all', function ($categories) {

	$lgfb_category = [
		'slug'  => 'lgfb',
		'title' => __('LGFB', 'lgfb')
	];

	array_unshift($categories, $lgfb_category);

	return $categories;
});

// Populate Taxonomy Field in Routing Cards Taxonomy Field 
add_filter('acf/load_field/name=routing-cards_taxonomy', function ($field) {
	// Get all custom taxonomies
	$taxonomies = get_taxonomies(['_builtin' => false], 'objects');

	// Initialize an array to hold taxonomy choices
	$choices = [];

	if ($taxonomies) {
		foreach ($taxonomies as $taxonomy) {
			// Get terms for this taxonomy
			$terms = get_terms([
				'taxonomy' => $taxonomy->name,
				'hide_empty' => false,
			]);

			// Check if terms exist for the taxonomy
			if (!empty($terms) && !is_wp_error($terms)) {
				foreach ($terms as $term) {
					// Add the term options in the format of taxonomy_slug_term_slug
					$value = $taxonomy->name . '_' . $term->slug;
					$label = ucfirst($taxonomy->label) . ' - ' . $term->name;

					// Add the term to the choices
					$choices[$value] = $label;
				}
			}
		}
	}

	// Assign choices to the select field
	$field['choices'] = $choices;

	return $field;
});

// Disable core spacer block in Gutenberg
add_filter('allowed_block_types_all', __NAMESPACE__ . '\\disable_spacer_block');

function disable_spacer_block($allowed_blocks)
{
	// Get all registered blocks
	$blocks = \WP_Block_Type_Registry::get_instance()->get_all_registered();

	// Disable the Spacer Block
	unset($blocks['core/spacer']);

	// Return the new list of allowed blocks
	return array_keys($blocks);
}
