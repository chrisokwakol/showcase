<?php

namespace App\Hooks;

use Illuminate\Support\ServiceProvider;

/**
 * Custom Post Type Provider
 *
 * All it does is register CPTs and Taxonomies, it's not really a provider.  :( sorry.
 */
class CustomPostTypes extends ServiceProvider
{
    protected int $menu_position = 99;

    /**
     * This provider uses extended-cpts to create post types and taxonomies.
     *
     * @link https://github.com/johnbillion/extended-cpts
     */
    public function register(): void
    {
        // Register taxonomies
        foreach ($this->taxonomies() as $taxonomy => $args) {
            register_taxonomy($taxonomy, $args['post_types'], $args);
        }

        add_action('init', function () {

            if (!empty($this->post_types())) {
                foreach ($this->post_types() as $key => $post_type) {
                    register_extended_post_type($key, $post_type, $post_type['names']);
                }
            }
        });
    }

    /**
     * Returns the Custom Post Type arrays.
     * @link https://github.com/johnbillion/extended-cpts/wiki/Registering-Post-Types
     * @return array
     */
    protected function post_types()
    {

        return [

            // //---------------------------------------------------------------------------
            // // Testimonials
            // //---------------------------------------------------------------------------
            'testimonial' => [
                'enter_title_here' => __('Enter Testimonial name', 'lgfb'),
                'menu_icon' => 'dashicons-testimonial',
                'supports' => ['title'],
                'menu_position' => $this->menu_position,
                'show_in_rest' => true,
                'has_archive' => false,
                'hierarchical' => true,
                'names' => [
                    'plural' => __('Testimonials', 'lgfb'),
                    'singular' => __('Testimonial', 'lgfb'),
                ],
                'admin_cols' => []
            ],

            //---------------------------------------------------------------------------
            // Modal
            //---------------------------------------------------------------------------
            'lgfb-modal' => [
                'enter_title_here' => __('Enter Modal name', 'lgfb'),
                'menu_icon' => 'dashicons-money',
                'supports' => ['title'],
                'menu_position' => $this->menu_position,
                'show_in_rest' => true,
                'has_archive' => false,
                'hierarchical' => true,
                'names' => [
                    'plural' => __('LGFB Modals', 'lgfb'),
                    'singular' => __('LGFB Modal', 'lgfb'),
                ],
                'admin_cols' => []
            ],

            // //---------------------------------------------------------------------------
            // // Resource Strings
            // //---------------------------------------------------------------------------
            // 'resource_string' => [
            //     'enter_title_here' => __('Enter string key: template.section.component.part', 'sprout'),
            //     'menu_icon' => $this->svg_to_base64('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M0 32l32 0 160 0 64 0 160 0 32 0 0 32 0 64 0 32-64 0 0-32 0-32L256 96l0 320 48 0 32 0 0 64-32 0-160 0-32 0 0-64 32 0 48 0 0-320L64 96l0 32 0 32L0 160l0-32L0 64 0 32z"/></svg>'),
            //     'supports' => ['title', 'revisions'],
            //     'menu_position' => $this->menu_position,
            //     'show_in_rest' => false,
            //     'publicly_queryable' => false,
            //     'has_archive' => false,
            //     'hierarchical' => false,
            //     'rewrite' => array('slug' => 'strings'),
            //     'names' => [
            //         'plural' => __('Strings', 'sprout'),
            //         'singular' => __('String', 'sprout'),
            //     ],
            //     'admin_cols' => [
            //         'copy_component' => array(
            //             'title' => 'Copy Snippets',
            //             'function' => function ($post_id) {
            //                 global $post;
            //                 echo '<div class="button-group">';
            //                 echo '<button data-resource-string-copy-shortcode data-key="' . $post->post_title . '" class="button button-small button-secondary" type="button">Shortcode</button>';
            //                 echo '<button data-resource-string-copy-component data-key="' . $post->post_title . '" class="button button-small button-secondary" type="button">Blade Component</button>';
            //                 echo '<button data-resource-string-copy-inline data-key="' . $post->post_title . '" class="button button-small button-secondary" type="button">PHP Function</button>';
            //                 echo '</div>';
            //             },
            //         ),
            //     ]
            // ],

            //---------------------------------------------------------------------------
            // Resource
            //---------------------------------------------------------------------------
            'resource' => [
                'enter_title_here' => __('Enter Resource name', 'lgfb'),
                'menu_icon' => 'dashicons-archive',
                'supports' => ['title', 'thumbnail', 'editor'],
                'menu_position' => $this->menu_position,
                'show_in_rest' => true,
                'has_archive' => false,
                'hierarchical' => true,
                'names' => [
                    'plural' => __('Resources', 'lgfb'),
                    'singular' => __('Resource', 'lgfb'),
                ],
                'admin_cols' => []
            ],

            //---------------------------------------------------------------------------
            // Workshops
            //---------------------------------------------------------------------------
            'workshop' => [
                'enter_title_here' => __('Enter Workshop name', 'lgfb'),
                'menu_icon' => 'dashicons-hammer',
                'supports' => ['title', 'thumbnail'],
                'menu_position' => $this->menu_position,
                'show_in_rest' => true,
                'has_archive' => false,
                'hierarchical' => true,
                'names' => [
                    'plural' => __('Workshops', 'lgfb'),
                    'singular' => __('Workshop', 'lgfb'),
                ],
                'admin_cols' => []
            ],

            //---------------------------------------------------------------------------
            // Events
            //---------------------------------------------------------------------------
            'event' => [
                'enter_title_here' => __('Enter Event name', 'lgfb'),
                'menu_icon' => 'dashicons-calendar',
                'supports' => ['title', 'thumbnail'],
                'menu_position' => $this->menu_position,
                'show_in_rest' => true,
                'has_archive' => false,
                'rewrite' => false,
                'hierarchical' => true,
                'names' => [
                    'plural' => __('Events', 'lgfb'),
                    'singular' => __('Event', 'lgfb'),
                ],
                'admin_cols' => []
            ],

            //---------------------------------------------------------------------------
            // Speaker Series
            //---------------------------------------------------------------------------
            'speaker_series' => [
                'enter_title_here' => __('Enter Speaker series name', 'lgfb'),
                'menu_icon' => 'dashicons-microphone',
                'supports' => ['title', 'thumbnail', 'editor'],
                'menu_position' => $this->menu_position,
                'show_in_rest' => true,
                'has_archive' => false,
                'rewrite' => false,
                'hierarchical' => true,
                'names' => [
                    'plural' => __('Speaker series', 'lgfb'),
                    'singular' => __('Speaker series', 'lgfb'),
                ],
                'admin_cols' => []
            ],
        ];
    }

    protected function taxonomies()
    {
        $post_types = ['page', 'post', 'resource', 'event', 'speaker_series', 'workshop'];

        return [
            'topic' => [
                'post_types' => $post_types,
                'labels' => [
                    'name'              => __('Topics', 'text-domain'),
                    'singular_name'     => __('Topic', 'text-domain'),
                    'search_items'      => __('Search Topics', 'text-domain'),
                    'all_items'         => __('All Topics', 'text-domain'),
                    'parent_item'       => __('Parent Topic', 'text-domain'),
                    'parent_item_colon' => __('Parent Topic:', 'text-domain'),
                    'edit_item'         => __('Edit Topic', 'text-domain'),
                    'update_item'       => __('Update Topic', 'text-domain'),
                    'add_new_item'      => __('Add New Topic', 'text-domain'),
                    'new_item_name'     => __('New Topic Name', 'text-domain'),
                    'menu_name'         => __('Topics', 'text-domain'),
                ],
                'hierarchical' => true,
                'show_in_rest' => true,
                'public' => true,
            ],
            'treatment-stage' => [
                'post_types' => $post_types,
                'labels' => [
                    'name'              => __('Treatment Stages', 'text-domain'),
                    'singular_name'     => __('Treatment Stage', 'text-domain'),
                    'search_items'      => __('Search Treatment Stages', 'text-domain'),
                    'all_items'         => __('All Treatment Stages', 'text-domain'),
                    'parent_item'       => __('Parent Treatment Stage', 'text-domain'),
                    'parent_item_colon' => __('Parent Treatment Stage:', 'text-domain'),
                    'edit_item'         => __('Edit Treatment Stage', 'text-domain'),
                    'update_item'       => __('Update Treatment Stage', 'text-domain'),
                    'add_new_item'      => __('Add New Treatment Stage', 'text-domain'),
                    'new_item_name'     => __('New Treatment Stage Name', 'text-domain'),
                    'menu_name'         => __('Treatment Stages', 'text-domain'),
                ],
                'hierarchical' => true,
                'show_in_rest' => true,
                'public' => true,
            ],
            'audience-type' => [
                'post_types' => $post_types,
                'labels' => [
                    'name'              => __('Audience Types', 'text-domain'),
                    'singular_name'     => __('Audience Type', 'text-domain'),
                    'search_items'      => __('Search Audience Types', 'text-domain'),
                    'all_items'         => __('All Audience Types', 'text-domain'),
                    'parent_item'       => __('Parent Audience Type', 'text-domain'),
                    'parent_item_colon' => __('Parent Audience Type:', 'text-domain'),
                    'edit_item'         => __('Edit Audience Type', 'text-domain'),
                    'update_item'       => __('Update Audience Type', 'text-domain'),
                    'add_new_item'      => __('Add New Audience Type', 'text-domain'),
                    'new_item_name'     => __('New Audience Type Name', 'text-domain'),
                    'menu_name'         => __('Audience Types', 'text-domain'),
                ],
                'hierarchical' => true,
                'show_in_rest' => true,
                'public' => true,
            ],
            'gender' => [
                'post_types' => $post_types,
                'labels' => [
                    'name'              => __('Genders', 'text-domain'),
                    'singular_name'     => __('Gender', 'text-domain'),
                    'search_items'      => __('Search Genders', 'text-domain'),
                    'all_items'         => __('All Genders', 'text-domain'),
                    'parent_item'       => __('Parent Gender', 'text-domain'),
                    'parent_item_colon' => __('Parent Gender:', 'text-domain'),
                    'edit_item'         => __('Edit Gender', 'text-domain'),
                    'update_item'       => __('Update Gender', 'text-domain'),
                    'add_new_item'      => __('Add New Gender', 'text-domain'),
                    'new_item_name'     => __('New Gender Name', 'text-domain'),
                    'menu_name'         => __('Genders', 'text-domain'),
                ],
                'hierarchical' => true,
                'show_in_rest' => true,
                'public' => true,
            ],
        ];
    }


    public function svg_to_base64($icon = '', $fallbackIcon = 'dashicons-welcome-add-page')
    {
        if (!$icon) return $fallbackIcon;

        return 'data:image/svg+xml;base64,' . base64_encode($icon);
    }
}
