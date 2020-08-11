<?php
add_action('after_setup_theme', function () {
  register_nav_menus(array(
    'header' => 'Main navigation',
    'header2' => 'Main 2 navigation'
  ));
  // register_nav_menu('header', __('Main navigation'), 'Science Tech');
  // register_nav_menu('logs', __('Logs navigation'), 'Science Tech');
  // register_nav_menu('header2', __('Main 2 navigation'), 'Science Tech');
});

require_once('widgets/social.php');

add_action('widgets_init', function () {
  // register_widget(SienceTech_Social_Widget::class);
  register_sidebar([
    'id' => 'footer',
    'name' => __('Footer', 'ScienceTech'),
    'before_title' => '<div class="footer__title">',
    'after_title' => '</div>',
    'before_widget' => '<div class="footer__col">',
    'after_widget' => '</div>'
  ]);
});
