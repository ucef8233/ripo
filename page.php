<?php //default page 
?>
<?php get_header(); ?>
<div class="container">
    <h1><?php the_title(); ?> </h1>
    <?php get_template_part('template/section', 'content'); ?>
</div>
<?php get_footer(); ?>