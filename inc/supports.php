<?php
defined('ABSPATH') or die('');

add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('menus');
  add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
  add_theme_support('post-thumbnails');

  add_image_size('news', 370, 280, true);
  add_image_size('news2', 150, 100, true);
  add_image_size('news2_large', 1140, 650, true);
  add_image_size('blog-large', 800, 400, true);
  add_image_size('blog-small', 300, 200, true);
  add_image_size('sliders', 1920, 500, array('center', 'center'));
});
add_theme_support('custom-background', $defaults);
add_theme_support('widgets');
$defaults = array(
  'default-image'          => '',
  'default-preset'         => 'default', // 'default', 'fill', 'fit', 'repeat', 'custom'
  'default-position-x'     => 'left',    // 'left', 'center', 'right'
  'default-position-y'     => 'top',     // 'top', 'center', 'bottom'
  'default-size'           => 'auto',    // 'auto', 'contain', 'cover'
  'default-repeat'         => 'repeat',  // 'repeat-x', 'repeat-y', 'repeat', 'no-repeat'
  'default-attachment'     => 'scroll',  // 'scroll', 'fixed'
  'default-color'          => '',
  'wp-head-callback'       => '_custom_background_cb',
  'admin-head-callback'    => '',
  'admin-preview-callback' => '',
);
add_filter('upload_mimes', function ($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
});

add_filter('comment_form_fields', 'wpsites_comment_form_fields');

function wpsites_comment_form_fields($fields)
{

  unset($fields['author']);
  unset($fields['email']);
  unset($fields['comment']);
  unset($fields['url']);
  unset($fields['cookies']);



  $fields['author'] = ' <div class="form-group"><label for="name-author">Name</label><input type="text" class="form-control" id="name-author" name="author" aria-describedby="emailHelp" placeholder="Enter your name"></div>';

  $fields['email']  = ' <div class="form-group"><label for="email">Email address</label><input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"></div>';

  $fields['comment']  = ' <div class="form-group"><label for="comment">Comment</label><textarea name="comment" class="form-control" id="comment" rows="3"></textarea></div>';

  $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" /> <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label></p>';
  return $fields;
}
/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
  return 20;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);


//links class

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
