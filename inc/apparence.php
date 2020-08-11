<?php
//Gestion du logo 
add_action('customize_register', function (WP_Customize_Manager $manager) {
  $manager->add_section('ScienceTech_appearance', [
    'title' => __('Theme appearance'),
  ]);
  $manager->add_setting('logo', [
    'sanitize_callback' => 'esc_url_raw'
  ]);
  //aploder une image 
  $manager->add_control(new WP_Customize_Image_Control($manager, 'logo', [
    'label' => __('Logo', 'Science Tech'),
    'section' => 'ScienceTech_appearance',
  ]));
});
// Logo support
add_theme_support('custom-logo', array(
  'height'      => 20,
  'width'       => 100,
  'flex-height' => true,
  'flex-width'  => true,
));
