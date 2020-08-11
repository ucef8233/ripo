<?php
if (have_rows('carousel')) :
?>
  <div class="flexslider">
    <ul class="slides">
      <?php
      while (have_rows('carousel')) : the_row(); ?>
        <?php $image = get_sub_field('image');
        $title = get_sub_field('title');  ?>
        <?php $image = get_sub_field('image');
        $imageurl = $image['sizes']['sliders'];
        $imagealt = $image['caption'];
        ?>
        <li>
          <img src="<?php echo "$imageurl"; ?>" class="d-block" alt="<?php echo $imagealt; ?>">
          <h5><?php the_sub_field('title') ?></h5>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
<?php endif; ?>