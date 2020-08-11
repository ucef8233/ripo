<?php get_header(); ?>



<section class="archive-sect">
<h1 class="header-archive"> <?php echo single_cat_title(); //this page of the all category ?></h1>

<div class="row">
<div class="slid-container">

</div>

</div>

<div class="row">

    

<div class="container ">
               <div class="tcards">
                    <?php get_template_part('includes/section','archive');?>
                </div>
               <a href=""  class="nxt-page"> <?php previous_posts_link(); ?></a>
                <?php next_posts_link();?>

            </div>

</div>           

</section>


<?php get_footer(); ?>