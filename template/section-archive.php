<?php 
if( have_posts() ): while( have_posts() ): the_post();?> 

<div class="cards">

        
        <a  class="" href="<?php the_permalink(); ?>" > 
        <img src=" <?php echo the_post_thumbnail_url('blog-small'); ?>" class="cards-img" style="width:22rem" alt="..."> 
        </a>

        <div class="archive-info ">
                  
                    <div class="times">
                        <p><i class="far fa-clock"></i> </p>
                      <p class="archive-date time times-p"><?php the_time('F, j, Y'); ?> </p>
                        </div>
                      <div>

                      <!-- <p class="archive-author">
                        <?php //the_author();
                        // the_author_link();
                        //   echo $fname; ?> <?php// echo $lname;
                          //echo get_the_author_meta("display_name"); ?>
                      </p> -->
                      </div>
            </div>
         
       
        <div class="cards-body" style="width:22rem">
        <a  class="" href="<?php the_permalink(); ?>" > <h5 class="cards-title"><?php the_title();?></h5>      </a>
             
        <?php  echo '<p class="cards-content">' . get_the_excerpt() . '</p>' ?>
            </p>
             <?php // the name of the author 
                                    $fname = get_the_author_meta('first_name');
                                    $lname = get_the_author_meta('last_name');
                            ?>
             
             
        </div>
<div class="archive-info">
  <div>
  <a  class="" href="<?php the_permalink(); ?>" > <button class="btn btn-border border btn-read-more pr-3">  Read More <i class="fas fa-long-arrow-alt-right flech"></i></button>      </a>

  </div>
  <div >

  <span>
  <i class="fas fa-comment"></i>
    <?php comments_popup_link('No Comments', 'One Comment', '% Comments', 'comment-url', 'Comments Disabled '); ?>
  </span>


  </div>


<div>
  <!-- comment -->
</div>
</div>
       
    </div>





<?php endwhile; else: endif;?>




