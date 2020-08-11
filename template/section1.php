<?php
$args_post = [
  'post_type' => 'post',
  'posts_per_page' => 5
];
$last_post = new WP_Query($args_post);
?>
<section class="news_container">
  <div class="news_bar">
    <h4>last articles</h4>
  </div>
  <article class="news">
    <?php
    if ($last_post->have_posts()) : ?>
      <?php while ($last_post->have_posts()) : $last_post->the_post();
        $last_post->the_content(); ?>
        <div class="news_card">
          <a class="news_link" href="<?php the_permalink() ?>">
            <?php the_post_thumbnail('news', ['class' => 'card-img-top', 'alt' => 'images d\'article', 'style' => 'height:auto']) ?> </a>
          <h5 class="news_categorie"><?php the_category('&bull;') ?></h5>
          <a class="news_link news_title " href="<?php the_permalink() ?>"><?php the_title() ?></a>
          <p class="news_date "><small><?php the_time(get_option('date_format')); ?> - Par <?php the_author() ?></small> </p>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </article>

</section>