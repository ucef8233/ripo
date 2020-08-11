<?php
/*
Template Name: edit user profile
*/
get_header();
if (is_user_logged_in()) {
    // user already log in
    wp_redirect(home_url());
}
?>
<main class="resetPass">
    <div class="resetPass">

        <?php
        if (isset($_REQUEST['errors']) && !empty($_REQUEST["errors"])) {
            $error_codes = explode(',', $_REQUEST['errors']);
            foreach ($error_codes as $err) {
                echo "<div class='alert alert-warning'>" . $err . "
                            <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        </div>";
            }
        } else if (isset($_REQUEST['checkemail']) && $_REQUEST["checkemail"] == "confirm") {
            echo "<div class='alert alert-success'> email was sent successfully check your email
                            <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        </div>";
        } else if (isset($_REQUEST['login']) && $_REQUEST["login"] == "invalid") {
            echo "<div class='alert alert-warning'> 
                            the key is invalid
                        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    </div>";
        } else if (isset($_REQUEST['login']) && $_REQUEST["login"] == "error") {
            echo "<div class='alert alert-warning'> 
                            we couldn't reseting your password
                        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    </div>";
        } else if (isset($_REQUEST['login']) && $_REQUEST["login"] == "expiredkey") {
            echo "<div class='alert alert-warning'> 
                            your key is expired
                        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    </div>";
        } else if (isset($_REQUEST['login']) && $_REQUEST["login"] == "invalidkey") {
            echo "<div class='alert alert-warning'> 
                            your key is invalid
                        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    </div>";
        }
        ?>

        <h3>Reset your password</h3>
        <p>
            Enter your email address below. We'll look for your account and send you a password reset email.
        </p>
        <form method="POST" action="<?php echo wp_lostpassword_url(); ?>">
            <!-- <input type="hidden" value="lost_password" name='action'/> -->
            <?php wp_nonce_field('resetPassword-user-nonce', 'reset_password'); ?>
            <div class="form-group">
                <label for="resetPassword">EMAIL</label>
                <input type="text" name="user_login" id="resetPassword" class="form-control" placeholder="enter Your Email" />
                </di>
                <div class="form-group">
                    <button type="submit" class="btn">Send Password Reset</button>
                </div>
        </form>
    </div>
    </div>
</main>




<?php get_footer() ?>