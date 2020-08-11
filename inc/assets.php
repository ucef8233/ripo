<?php
define('Y_VERSION', '0.0.13');
add_action('wp_enqueue_scripts', function () {

  wp_enqueue_style("A_font-awesome_style", get_template_directory_uri() . "/assets/icons/css/all.css", array(), Y_VERSION, 'all');
  wp_enqueue_style("A_bx-slider-css", get_template_directory_uri() . "/assets/bxslider/dist/jquery.bxslider.min.css", array(), Y_VERSION, 'all');
  wp_enqueue_style("custom-main-css", get_template_directory_uri() . "/assets/css/A_main.css", array(), Y_VERSION, 'all');


  wp_enqueue_style('M_bootstrap_style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), Y_VERSION, 'all');
  wp_enqueue_style('M_main_style', get_template_directory_uri() . '/assets/css/M_main.css', array(), Y_VERSION, 'all');
  wp_enqueue_style('M_flexslider_style', get_template_directory_uri() . '/assets/css/flexslider.css', array(), Y_VERSION, 'all');
  wp_enqueue_style('M_fontawesom_style', get_template_directory_uri() . '/assets/css/all.css', array(), Y_VERSION, 'all');




  wp_enqueue_style('Y_section1_style', get_template_directory_uri() . '/assets/css/section1.css', [], Y_VERSION, 'all');
  wp_enqueue_style('Y_section2_style', get_template_directory_uri() . '/assets/css/section2.css', [], Y_VERSION, 'all');
  wp_enqueue_style('Y_nav_style', get_template_directory_uri() . '/assets/css/nav.css', [], Y_VERSION, 'all');

  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery', false, true);
  wp_enqueue_script('flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', 'jquery', false, true);


  wp_enqueue_script("bootstrap-js", get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), false, true);
  wp_enqueue_script("bxslider-js", get_template_directory_uri() . '/assets/bxslider/dist/jquery.bxslider.min.js', array('jquery'), false, true);
  wp_enqueue_script("custom-js", get_template_directory_uri() . "/assets/js/main.js", array('jquery'), NULL, true);
  wp_enqueue_script("clipboard", get_template_directory_uri() . "assets/js/clipboard.min.js", array(), false, true);



  wp_enqueue_script('Y_section2_script', get_template_directory_uri() . '/assets/js/section2.js', ['jquery'], false, true);
});
