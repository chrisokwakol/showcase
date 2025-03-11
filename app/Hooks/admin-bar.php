<?php

add_action('admin_bar_menu', 'sprout_theme_options', 500);
function sprout_theme_options($wp_admin_bar)
{

	if (!current_user_can('manage_options')) {
		return;
	}

	$args = array(
		'id'    => 'theme_options',
		'title' => __('Theme Options', 'sprout'),
		'href'  => admin_url('admin.php?page=theme-options'),
		'meta'  => array('class' => '')
	);

	$wp_admin_bar->add_node($args);
}
