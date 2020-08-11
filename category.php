<?php get_header(); ?>

<h1 class="header-archive"> <?php echo single_cat_title(); //this page of the all category 
                            ?></h1>
<section class=" ">


  <div class="size-slid">

    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php while (have_rows('slides')) : the_row(); ?>
          <?php $counter = get_row_index(); ?>
          <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $counter - 1; ?>" class="<?php if (get_row_index() == 1) echo 'active'; ?>"></li>
        <?php endwhile; ?>

      </ol>
      <div class="carousel-inner">
        <?php while (have_rows('slides')) : the_row(); ?>
          <?php $image = get_sub_field('image');
          $title = get_sub_field('title');  ?>
          <div class="carousel-item <?php if (get_row_index() == 1) echo 'active'; ?>">
            <?php $image = get_sub_field('image');
            $imageurl = $image['sizes']['sliders'];
            $imagealt = $image['caption'];
            ?>

            <img src="<?php echo "$imageurl"; ?>" class="d-block" alt="<?php echo $imagealt; ?>">

            <div class="carousel-caption d-none d-md-block ">
              <h5><?php the_sub_field('title') ?></h5>
              <p><?php the_sub_field('text') ?></p>
              <a href="<?php the_sub_field('button') ?>" class="btn btn-dark"> READ MORE</a>
            </div>
          </div>
        <?php endwhile; ?>

      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </div>


  <div class="row ">
    <div class="container">
      <div class="tcards">
        <?php get_template_part('template/section', 'archive'); ?>
      </div>
      <div class="buttun-nxt-previos">
        <?php previous_posts_link(); ?>
        <?php next_posts_link(); ?>
      </div>



    </div>

  </div>
  </div>
</section>




<?php get_footer(); ?>