<?php 
if( have_posts() ): while( have_posts() ): the_post();?> 
<?php if ( has_post_thumbnail() ): ?> 
   
   <img src=" <?php echo the_post_thumbnail_url('blog-large'); ?>" class="img-singl" style="width:800px; height:400px" alt="">

 <?php endif;?> 

<div class="content" style="width:800px" >
 <?php echo get_the_date('M D, Y'); // la date ?>
   <?php the_content();?>
   <?php // the name of the author 
            $fname = get_the_author_meta('first_name');
            $lname = get_the_author_meta('last_name');

            ?>
   <p>Posted by <?php echo $fname; ?> <?php echo $lname; ?> </p>
</div>
     
<?php 
//  la category // !!!!!!!i forgot to switch the name of the category to ana anchor" a tag "
    $categories = get_the_category();
    foreach($categories as $cat):?>
   <p> <?php echo $cat->name ; ?> </p>


<?php endforeach ?>

<?php endwhile; else: endif;?>