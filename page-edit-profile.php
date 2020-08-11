<?php
/*
Template Name: edit user profile
*/
get_header();
global $current_user, $wp_roles;
?>
<main class="updateUserMain">
    <div class="container updateUserContainer">
        <?php if (!is_user_logged_in()) : ?>
            <p class="warning">
                You must be logged in to edit your profile.
            </p><!-- .warning -->
        <?php else :
            if (isset($_REQUEST['error']) && $_REQUEST["error"] == 1) {
                echo "<div class='alert alert-warning'>
                            first name must contains only letters
                            <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        </div>";
            }
            if (isset($_REQUEST['error']) && $_REQUEST["error"] == 2) {
                echo "<div class='alert alert-warning'>
                            last name must contains only letters
                            <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        </div>";
            }
            if (isset($_REQUEST['error']) && $_REQUEST["error"] == 3) {
                echo "<div class='alert alert-warning'>
                            email not valid
                            <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        </div>";
            }
        ?>
            <h3>Account Settings</h3>
            <form id="updateUser" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
                <input type="hidden" value="updatingUser" name='action' />
                <?php wp_nonce_field('update-user-nonce', 'update_user'); ?>
                <div class="row">
                    <div class="col-md-2 profileImage">
                        <p class="form-url">
                            <?php
                            //action for extra fields
                            // echo do_action('edit_user_profile',$current_user); 
                            echo do_shortcode("[avatar_upload]");
                            //   echo get_avatar($current_user->ID)
                            //do_action('show_user_profile',$current_user->ID);

                            ?>
                        </p>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input class="form-control" name="updatedfirstname" type="text" id="updatedfirstname" value="<?php the_author_meta('first_name', $current_user->ID); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input class="form-control" name="updatedlastname" type="text" id="updatedlastname" value="<?php the_author_meta('last_name', $current_user->ID); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" name="updatedemail" type="text" id="updatedemail" value="<?php esc_attr(the_author_meta('user_email', $current_user->ID)); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="description">Biographical Information</label>
                            <textarea name="updateddescription" id="updateddescription" rows="4" cols="50" class="form-control"><?php esc_attr(the_author_meta('description', $current_user->ID)); ?></textarea>
                        </div>
                        <div class="form-submit">
                            <input name="updateuser" type="submit" id="updateuserbtn" class="btn blackBtn" value="Update" />
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
    </div>
</main>



<?php get_footer() ?>