
<?php 
/*
Template Name: form to reset the password
*/
get_header(); ?>
<main class="resetpassword">
    <div class="container resetpasscontainer">
            <?php if ( is_user_logged_in() ) {
                echo "you already log in";
            }
            else {
                if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {?>
                    <div id="password-reset-form" class="widecolumn">
                        
                        <h3>Pick a New Password</h3>
 
                        <form name="resetpassform" id="resetpassform" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>" method="post" autocomplete="off">
                            <input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $_REQUEST['login'] ); ?>" autocomplete="off" />
                            <input type="hidden" name="rp_key" value="<?php echo esc_attr( $_REQUEST['key'] ); ?>" />
                            <div class="form-group">
                                <label for="pass1">New password</label>
                                <input type="password" name="pass1" id="pass1" class="form-control" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <label for="pass2">Repeat new password</label>
                                <input type="password" name="pass2" id="pass2" class="form-control" autocomplete="off" />
                            </div>
                
                            <p class="description"><?php echo wp_get_password_hint(); ?></p>
                
                            <div class="form-group">
                                <input type="submit" name="submit" id="resetpass-button" class="btn blackBtn" value="Reset Password" />
                            </div>
                        </form>
                    </div>
                 <?php    
                 }
             }
                ?>
        </div>
    </div>
</main>



<?php get_footer() ?>


