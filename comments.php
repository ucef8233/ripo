<?php 
$count=absint(get_comments_number());
?>

<?php 
$argscomments = array(
    'walker'            => null,
    'max_depth'         => '',
    'style'             => 'ul',
    'callback'          => null,
    'end-callback'      => null,
    'type'              => 'all',
    'page'              => '',
    'per_page'          => '',
    'avatar_size'       => 60,
    'reverse_top_level' => null,
    'reverse_children'  => '',
    'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
    'short_ping'        => false,   // @since 3.6
    'echo'              => true     // boolean, default is true
);
?>





<ul class="commentlist">
<?php wp_list_comments($argscomments) ?>  
</ul>
<?php if($count >0):?>
   

<?php else:?>
    
    <?php endif ?>


<?php if(comments_open()): ?>
   <?php  comment_form() ?>   
   <?php endif ?>    
 