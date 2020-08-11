<section class="section_2">
  <?php $categories = get_categories(array(
    'orderby' => 'name',
    'order' => 'ASC'
  )); ?>
  <div class="bar">
    <ul class="container-onglets block_cat">
      <?php foreach ($categories as $id => $category) : ?>
        <li class="onglets <?php if ($id == 0) : echo "active";
                            endif; ?>" data-anim="<?= $id + 1 ?>">
          <?= esc_html($category->name); ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <ul class="categ_hum hidden">
      <li><img class="float-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/icone.png" alt="icone"></li>
    </ul>

  </div>
  <div class="categories">
    <div class="socials">
      <h4>Suivez-Nous</h4>
      <div class="icone">
        <div> 1000 facebook</div>
        <div> 1000 twitter</div>
        <div>1000 instagram</div>
        <!-- a refaire  -->
      </div>
    </div>

    <div class="comments">
      <h4>the most viewed lists</h4>
      <?php
      $views_args = [
        'order' => 'ASC',
        'orderby' => 'comment_count',
        'posts_per_page' => 4
      ];
      $views_post = new WP_Query($views_args); ?>
      <?php if ($views_post->have_posts()) : ?>
        <?php while ($views_post->have_posts()) : $views_post->the_post() ?>
          <div class="news_comment news_comment-size">
            <h5 class="news_categorie"><?php the_category('&bull;') ?></h5>
            <a class="news_link news_title link_comments" href="<?php the_permalink() ?>"><?php the_title() ?></a>
            <p class="news_date "><small><?php the_time(get_option('date_format')); ?> - Par <?php the_author() ?></small> </p>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>


    <?php foreach ($categories as $id => $category) : ?>
      <?php
      $test_args = [
        'post_type' => 'post',
        'posts_per_page' => 7,
        'category_name' => $category->name
      ];
      $test_post = new WP_Query($test_args);
      ?>
      <div class="contenu <?php if ($id == 0) : echo "activeContenu";
                          endif; ?>" data-anim="<?= $id + 1 ?>">
        <?php $id_image = 0; ?>
        <?php if ($test_post->have_posts()) : ?>
          <?php while ($test_post->have_posts()) : $test_post->the_post() ?>
            <div class="article">
              <?php if ($id_image == 0) : ?>
                <?php the_post_thumbnail('news2_large', ['class' => 'float', 'alt' => 'images d\'article']) ?><a href="<?php the_permalink() ?>"><?php the_title() ?></a>
              <?php else : ?>
                <?php the_post_thumbnail('news2', ['class' => 'float', 'alt' => 'images d\'article', 'style' => 'height:auto']) ?><a href="<?php the_permalink() ?>"><?php the_title() ?></a>
              <?php endif ?>
              <p class="news_date "><small><?php the_time(get_option('date_format')); ?> - Par <?php the_author() ?></small> </p>
            </div>
            <?php $id_image++ ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php the_content(); ?>
  <?php endwhile;
  endif; ?>

</section>