<?php
function tiny_mce_add_buttons($plugins)
{
  $plugins['mytinymceplugin'] = get_template_directory_uri() . '/resources/scripts/components/tiny-mce.js';
  return $plugins;
}

function tiny_mce_register_buttons($buttons)
{
  $newBtns = array(
    'filledbtn',
    'hollowbtn',
  );
  $buttons = array_merge($buttons, $newBtns);
  return $buttons;
}

function tiny_mce_new_buttons()
{
  add_filter('mce_external_plugins', 'tiny_mce_add_buttons');
  add_filter('mce_buttons', 'tiny_mce_register_buttons');
}

add_action('init', 'tiny_mce_new_buttons');
