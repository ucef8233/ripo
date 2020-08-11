<?php
// get substring from title
function title_substring($title)
{
  if (strlen($title) > 50) {
    return substr($title, 0, 50) . "...";
  } else {
    return $title;
  }
}

// for register part
function signup_initialise()
{
  wp_enqueue_script("signup_init", get_template_directory_uri() . "/assets/js/ajaxcall.js", array(), '', true);
  wp_localize_script("signup_init", "registrationInfo", array(
    "ajaxurl" => admin_url('admin-ajax.php'),
    "redirecturl" => home_url()
  ));
}

if (!is_user_logged_in()) {
  add_action('init', 'signup_initialise');
}


// validate user data before insert it into database
function validata_data($password, $username, $email, $firstname, $lastname, $confirmpassword)
{
  $errors = [];
  if (!preg_match('/^[a-zA-Z0-9@]+$/', $username) || strlen($username) < 3) {
    $errors[] = "username countains letters, numbers and @ and > 2 char";
  }
  if (strlen($password) < 6) {
    $errors[] = "password must be > 6 character";
  }
  if ($password != $confirmpassword) {
    $errors[] = "confirmed password does not match";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {
    $errors[] = "email is not valid";
  }
  if (empty($firstname) || !ctype_alpha($firstname)) {
    $errors[] = "firstname should contains letters only";
  }
  if (empty($lastname) || !ctype_alpha($lastname)) {
    $errors[] = "lastname should contains letters only";
  }
  return $errors;
} // extract user information and add it to database 
function signup_user()
{
  if ('POST' == $_SERVER['REQUEST_METHOD']) { // remove white space from begginning and the end of the string 
    $password = $_POST['password'];
    $username = $_POST['username'];
    $email = $_POST['email'] . trim();
    $firstname = $_POST['firstname'] . trim();
    $lastname = $_POST['lastname'] . trim();
    $confirmpassword = $_POST['confirmpassword'];
    $errors = validata_data($password, $username, $email, $firstname, $lastname, $confirmpassword); // if there is any errors in user data return those error; if (count($errors)> 0) {
    echo json_encode(array("errors" => $errors));
    die();
  }
  // verify nononce
  if (wp_verify_nonce($_POST['security'], 'ajax-register-nonce')) {

    // validate data

    // end validate data
    $userdata = array();
    $userdata['user_pass'] = $password;
    $userdata['user_login'] = $username;
    $userdata['user_email'] = $email;
    $userdata['first_name'] = $firstname;
    $userdata['last_name'] = $lastname;
    $userdata['role'] = "subscriber"; // should be updated later
    $userdata['show_admin_bar_front'] = '';

    $user_signup_id = wp_insert_user($userdata);

    // if there is no error while inserting the user
    if ($user_signup_id && !is_wp_error($user_signup_id)) {
      echo json_encode(array('success' => true, 'message' => __('Sign up successful')));
    }
    // if there is an error while inserting the user
    else {
      echo json_encode(array('success' => false, 'errors' => [$user_signup_id->get_error_message()]));
    }
    wp_set_current_user($user_signup_id);
    wp_set_auth_cookie($user_signup_id);
    wp_die();
  } else {
    wp_die();
  }
}


add_action("wp_ajax_registerUser", "signup_user"); // fire ajax call when the user is login
add_action("wp_ajax_nopriv_registerUser", "signup_user"); // fire when user is log out from front ent
// end extract user information and add it tot the database



// for logging process
function login_user()
{

  // if (!empty($_POST)) {
  if ('POST' == $_SERVER['REQUEST_METHOD']) {
    // verify nononce
    if (wp_verify_nonce($_POST['security'], 'ajax-login-nonce')) {

      // validate data
      if (empty($_POST['loginpassword']) || empty($_POST['login'])) {
        echo json_encode(array('success' => false, 'errors' => [__("password or login is incorrect")]));
        wp_die();
      }
      // end validate data
      $userdata = array();
      $userdata['user_login'] = $_POST['loginpassword'];
      $userdata['user_password'] = $_POST['login'];
      $info['remember'] = true;

      $user_sigin = wp_signon($userdata);

      // if there is no error while inserting the user
      if ($user_sigin && !is_wp_error($user_sigin)) {
        echo json_encode(array('success' => true, 'message' => __('Sign up successful')));
      } else {
        echo json_encode(array('success' => false, 'errors' => [__("password or login is incorrect")]));
      }
      wp_set_current_user($user_sigin);
      wp_die();
    } else {
      wp_die();
    }
  }
}

// Run before the headers and cookies are sent.
// add_action( 'after_setup_theme', 'loginuser');

add_action("wp_ajax_loginUser", "login_user"); // fire ajax call when the user is login
add_action("wp_ajax_nopriv_loginUser", "login_user"); // fire when user is log out from front ent


// when user request the the default log in url redirect the to home page
function redirect_to_home_page()
{
  wp_redirect(home_url());
}
add_action('login_form_login', "redirect_to_home_page");



// change the redirect page after logout
add_action('wp_logout', 'redirect_after_logout');
function redirect_after_logout()
{
  wp_redirect(home_url('/'));
  exit();
}



// reset password

add_action('login_form_lostpassword', "redirect_user_to_custom_reset");


/**
 * Redirects the user to the custom "Forgot your password?" page instead of
 * wp-login.php?action=lostpassword.
 */
function redirect_user_to_custom_reset()
{
  if ('GET' == $_SERVER['REQUEST_METHOD']) {
    if (is_user_logged_in()) {
      wp_redirect(home_url());
      exit;
    }
    wp_redirect(home_url('reset'));
    exit;
  }
}


add_action("login_form_lostpassword", "handle_user_custom_reset");
function handle_user_custom_reset()
{
  // dont forget to check for nonce
  if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if (wp_verify_nonce($_POST['reset_password'], 'resetPassword-user-nonce')) {
      $is_error_msg = retrieve_password();
      if (is_wp_error($is_error_msg)) {
        // Errors found
        $redirect_url = home_url('reset');
        $redirect_url = add_query_arg('errors', join(',', $is_error_msg->get_error_codes()), $redirect_url);
        // $redirect_url = add_query_arg( 'errors', $_POST['user_login'], $redirect_url );

      } else {
        // Email sent
        $redirect_url = home_url('reset');
        $redirect_url = add_query_arg('checkemail', 'confirm', $redirect_url);
      }
      wp_redirect($redirect_url);
      die();
    } else {
      die();
    }
  }
}

/* when user click on reset sending email should redirect to a custom page to enter the new password */
add_action('login_form_rp', 'redirect_to_custom_password_reset_process');
add_action('login_form_resetpass', 'redirect_to_custom_password_reset_process');
function redirect_to_custom_password_reset_process()
{
  if ('GET' == $_SERVER['REQUEST_METHOD']) {
    // Verify key / login combo
    $user = check_password_reset_key($_REQUEST['key'], $_REQUEST['login']);
    if (!$user || is_wp_error($user)) {
      if ($user && $user->get_error_code()) {
        wp_redirect(home_url('reset?login=invalid'));
      } else {
        wp_redirect(home_url('reset?login=error'));
      }
      exit;
    }
    $redirect_url = home_url('send-new-password');
    // use cookies later instead of guery
    $redirect_url = add_query_arg('login', esc_attr($_REQUEST['login']), $redirect_url);
    $redirect_url = add_query_arg('key', esc_attr($_REQUEST['key']), $redirect_url);

    wp_redirect($redirect_url);
    exit;
  }
}



// this still need to completed when the project is deployed
add_action('login_form_rp', 'do_password_reset');
add_action('login_form_resetpass', 'do_password_reset');
function do_password_reset()
{
  if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $rp_key = $_REQUEST['rp_key'];
    $rp_login = $_REQUEST['rp_login'];

    $user = check_password_reset_key($rp_key, $rp_login);

    if (!$user || is_wp_error($user)) {
      if ($user && $user->get_error_code() === 'expired_key') {
        wp_redirect(home_url('reset?login=expiredkey'));
      } else {
        wp_redirect(home_url('reset?login=invalidkey'));
      }
      exit;
    }

    if (isset($_POST['pass1'])) {
      if ($_POST['pass1'] != $_POST['pass2']) {
        // Passwords don't match
        $redirect_url = home_url('send-new-password');

        $redirect_url = add_query_arg('key', $rp_key, $redirect_url);
        $redirect_url = add_query_arg('login', $rp_login, $redirect_url);
        $redirect_url = add_query_arg('error', 'password_reset_mismatch', $redirect_url);

        wp_redirect($redirect_url);
        exit;
      }

      if (empty($_POST['pass1'])) {
        // Password is empty
        $redirect_url = home_url('send-new-password');

        $redirect_url = add_query_arg('key', $rp_key, $redirect_url);
        $redirect_url = add_query_arg('login', $rp_login, $redirect_url);
        $redirect_url = add_query_arg('error', 'password_reset_empty', $redirect_url);

        wp_redirect($redirect_url);
        exit;
      }

      // Parameter checks OK, reset password
      reset_password($user, $_POST['pass1']);
      wp_redirect(home_url());
    } else {
      echo "Invalid request.";
    }
    exit;
  }
}





// end reset password










add_action('admin_post_updatingUser', 'process_update_user');
function process_update_user()
{

  // if (!empty($_POST)) {
  if ('POST' == $_SERVER['REQUEST_METHOD']) {
    // verify nononce
    if (wp_verify_nonce($_POST['update_user'], 'update-user-nonce')) {
      // validate input before update data
      if (!filter_var($_POST["updatedemail"], FILTER_VALIDATE_EMAIL) || empty($_POST["updatedemail"])) {
        wp_redirect(home_url("edit-profile?error=3"));
        die();
      }
      if (empty($_POST["updatedfirstname"]) || !ctype_alpha($_POST["updatedfirstname"])) {
        wp_redirect(home_url("edit-profile?error=1"));
        die();
      }
      if (empty($_POST["updatedlastname"]) || !ctype_alpha($_POST["updatedlastname"])) {
        wp_redirect(home_url("edit-profile?error=2"));
        die();
      }
      $user_info = array(
        'ID' => get_current_user_id(),
        'first_name' => $_POST["updatedfirstname"],
        'last_name' => $_POST["updatedlastname"],
        'description' => $_POST["updateddescription"],
        'user_email' => $_POST["updatedemail"]
      );

      $user_data = wp_update_user($user_info);
      do_action('personal_options_update', get_current_user_id());

      if (is_wp_error($user_data)) {
        // There was an error; possibly this user doesn't exist.
        echo $user_data->get_error_message();
      } else {
        // Success!
        wp_redirect(home_url());
        die();
      }
    }
  }
  die();
}






  // function add_cap_upload() {
  // $role = get_role( 'subscriber' );
  // $role->add_cap( 'upload_files' );
  // $role->add_cap( 'edit_user' );
  // }
  // add_action( 'init', 'add_cap_upload' );


  // end update user



  /*
  *******
  **** end Added by elouadi
  *******
  */