<?php
/**
* Plugin Name: Restapi Login
* Plugin URI: http://www.solvepapers.com
* Description: Shortcode based login form. Enter an email/username and get link via email that will automatically log you in.
* Version: 3.0
* Author: solvepapers, Sahib
* Author URI: http:/www.solvepapers.com
* License: GPL2
*/
/* Copyright solvepapers.com 
 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
 
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation.
*/
define( 'WPA_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) );
define( 'WPA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WPA_TRANSLATE_DIR', WPA_PLUGIN_DIR.'/translation' );
define( 'WPA_TRANSLATE_DOMAIN', 'restapi' );
include("rest_api_login.php");
include("curl.php");
/**
 * Function that creates the "Basic Information" submenu page
 *
 * @since v.2.0
 *
 * @return void
 */
function wpa_register_basic_info_submenu_page() {
	add_submenu_page( 'users.php', __( 'HugeLogin', 'restapi' ), __( 'HugeLogin', 'restapi' ), 'manage_options', 'restapi-login', 'wpa_basic_info_content' );
}
add_action( 'admin_menu', 'wpa_register_basic_info_submenu_page', 2 );

/**
 * Function that adds content to the "Restapi Auth" submenu page
 *
 * @since v.1.0
 *
 * @return string
 */
function wpa_basic_info_content() { 
	include("plugin_info.php");
}

function wpa_register_settings_submenu_page() {
	add_menu_page("HugeLogin", "HugeLogin", /*"publish_posts",*/"manage_options", "restapidesc", "wpa_restapi_settings");
}
add_action('admin_menu', 'wpa_register_settings_submenu_page');

if(isset($_POST['restautoken'])){
	$value = sanitize_text_field( $_POST['restautoken'] );
	update_option("restautoken",$value);
}
if(isset($_POST['rest_api_form_options'])){
	$value = sanitize_text_field( $_POST['rest_api_form_options'] );
	update_option("rest_api_form_options",$value);
}

function wpa_restapi_settings(){
  wpa_enqueue_admin_style_and_script();
  include("plugin_settings.php");
}

function wpa_enqueue_admin_style_and_script(){
	wp_enqueue_script( 'restapi_script3', plugin_dir_url( __FILE__ ).  'js/jquery.js'  );
  	wp_enqueue_script( 'restapi_script4', plugin_dir_url( __FILE__ ).  'js/bootstrap.js'             );
  	wp_enqueue_style(  'restapi_style2',  plugin_dir_url( __FILE__ ) . 'css/bootstrap.css'         );  	
}

function wpa_enqueue_user_style_and_script(){
	wp_enqueue_script( 'restapi_script3', plugin_dir_url( __FILE__ ).  'js/jquery.js'  );
	wp_enqueue_script( 'restapi_script4', plugin_dir_url( __FILE__ ).  'js/bootstrap.js'  );
  	wp_enqueue_style(  'restapi_style1',  plugin_dir_url( __FILE__ ) . 'css/bootstrap.css'         );      
}

/**
 * Add scripts and styles to the back-end
 *
 * @since v.1.0
 *
 * @return void
 */
function wpa_print_script( $hook ){
	if ( ( $hook == 'users_page_restapi-login' ) ){
		wp_enqueue_style( 'wpa-back-end-style', WPA_PLUGIN_URL . 'assets/style-back-end.css', false, RESTAPI_LOGIN_VERSION );
	}
}
add_action( 'admin_enqueue_scripts', 'wpa_print_script' );

/**
 * Add scripts and styles to the front-end
 *
 * @since v.1.0
 *
 * @return void
 */
function wpa_add_plugin_stylesheet($hook) {
	$full_request  = $_SERVER['REQUEST_URI'];
    $token_r_page  =  isTokenLogin($full_request);
    $query_args    = isLoginPage(); 
    if( $query_args || $token_r_page) {
        wpa_enqueue_user_style_and_script();
    }	
}
add_action( 'wp_print_styles', 'wpa_add_plugin_stylesheet' );

/**
 * Shortcode for the restapi login form
 *
 * @since v.1.0
 *
 * @return html
 */
function wpa_front_end_login(){
	wp_print_styles();
	
	ob_start();
	$account = ( isset( $_POST['user_email_username']) ) ? $account = sanitize_text_field( $_POST['user_email_username'] ) : false;
	$nonce = ( isset( $_POST['nonce']) ) ? $nonce = sanitize_key( $_POST['nonce'] ) : false;
	$error_token = ( isset( $_GET['wpa_error_token']) ) ? $error_token = sanitize_key( $_GET['wpa_error_token'] ) : false;
    
	$sent_link = wpa_send_link($account, $nonce);
    $html_start = '<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><div class="container container-table" style="padding-top:10px;">
    <div class="row vertical-center-row">
    	<div class="col-md-4 col-md-ffset-4">&nbsp;</div>
        <div class="col-md-4 col-md-ffset-4" >';
    $html_login_head = '<div class="text-center">
        		<span class=".rest-api-logo" style="border-radius:50%;" >
        			<img style="width:40%;" src="'.WPA_PLUGIN_URL.'/img/logo_hugelogin.png"/>
        		</span>
                <p>Password free access to this site.  <a href="#" data-toggle="modal" data-target="#myModal">Learn More</a></p>
				<h3 style="display:none;" class="login-head text-success"><i>Huge Login</i></h3>
			</div>
            <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel"><img src="'.WPA_PLUGIN_URL.'/img/LockLogoGreen.png" style="width:10%;" border="0" alt="hugelogin logo"/> Password free access with HugeLogin</h4>
      </div>
      <div class="modal-body">
      <p>Just enter your email address, and we\'ll send you a verification request to gain access to this site.  Its that simple.  To disconnect, either logout or use the HugeLogin app to disconnect from anywhere.</p>
      <p class="text-center"><a href="http://www.hugelogin.com" target="_blank">http://www.hugelogin.com</a></p>
      </div>
    </div>
  </div>
</div>';
    $html_end = '</div></div></div>';

	if( $account && !is_wp_error($sent_link) ){

		$message_show= '<p style="margin-left:" class="page header wpa-box wpa-success">'. esc_html(apply_filters('wpa_success_link_msg', __('Please check your email. You will soon receive an email with a login link.', 'restapi') )) .'</p>';
		
		echo $html_start.$message_show.$html_end;
	} elseif ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		$message_show = '<p class="wpa-box wpa-alert">'.esc_html(apply_filters('wpa_success_login_msg', sprintf(__( 'You are currently logged in api as %1$s. %2$s', 'rest_apilogin' ), '<a href="'.$authorPostsUrl = get_author_posts_url( $current_user->ID ).'" title="'.$current_user->display_name.'">'.$current_user->display_name.'</a>', '<a href="'.wp_logout_url( $redirectTo = wpa_curpageurl() ).'" title="'.__( 'Log out of this account', 'rest_apilogin' ).'">'. __( 'Log out', 'rest_apilogin').' &raquo;</a>' ) )) . '</p><!-- .alert-->';
		echo $html_start.$message_show.$html_end;
	} else {
		echo $html_start;
		if ( is_wp_error($sent_link) ){
			$message_show='<p class="wpa-box wpa-error">' . esc_html(apply_filters( 'wpa_error', $sent_link->get_error_message() )) . '</p>';
			echo $message_show;
		}
		if( $error_token ) {
			echo '<p class="wpa-box wpa-error">' . esc_html(apply_filters( 'wpa_invalid_token_error', __('Your token has probably expired. Please try again.', 'restapi') ));
		}
		if(get_option("rest_api_form_options") == "use_both"){?>
			<div class="text-center panel-body">
				<img src="<?php echo esc_url(home_url()); ?>/wp-admin/images/w-logo-blue.png"/>
			</div>
        	<div class="loginform panel panel-success panel-body" style="box-shadow: 1px 1px 1px 1px;">           
            <h2><?php the_title(); ?></h2>

			<form name="loginform" id="loginform" action="<?php echo esc_url(home_url()); ?>/wp-login.php?action=login" method="post">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="log" id="user_login" class="form-control" 
					value="" size="20" tabindex="10" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="pwd" id="user_pass" class="form-control" 
					value="" size="20" tabindex="20" />
				</div>

				<p class="forgetmenot col-md-8">
					<label>
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> 
						Remember Me</label>
				</p>
				<p class="submit col-md-4">
					<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In" tabindex="100" />
					<input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url()); ?>/wp-admin/" />

					<input type="hidden" name="testcookie" value="1" />
				</p>
			</form>

			<p id="nav">
			<a href="<?php echo esc_url(home_url()); ?>/wp-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
			</p>
            <?php
            echo '</div>';
        }
		echo $html_login_head;?>	
				
				<div class="loginform panel panel-success panel-body" style="box-shadow: 1px 1px 1px 1px;">
					<?php include("login_forms.php");?>				
				</div>
	<?php echo $html_end;

	}
	$output = ob_get_contents();
	ob_end_clean();
	
	echo $output;
}
add_shortcode( 'huge-login', 'wpa_front_end_login' );

add_filter('widget_text', 'do_shortcode');

/**
 * Checks to see if an account is valid. Either email or username
 *
 * @since v.1.0
 *
 * @return bool / WP_Error
 */
function wpa_valid_account( $account ){

	if( is_email($account) && email_exists( $account ) ){
		return true;
	}
	else if( !is_email( $account ) && username_exists( $account ) ){
		$user = get_user_by('login', $account);
		if($user){
			true;
		}
	}
	return false;
}

/**
 * Sends an email with the unique login link.
 *
 * @since v.1.0
 *
 * @return bool / WP_Error
 */
function wpa_send_link( $email_account = false, $nonce = false ){
	if ( $email_account  == false ){
		return false;
	}
	$message  = "";
	$errors = new WP_Error;
	$response = token_request($email_account,$message);
	if ( !$response ){
		$errors->add('email_not_sent', __('There was a problem sending your email. Please try again or contact an admin.'));
	}
	$error_codes = $errors->get_error_codes();

	if (empty( $error_codes  )){
		return false;
	}else{
		return $errors;
	}
}

/**
 * Destroy HugeLogin session_token upon logout
 *
 * @since v.1.0
 *
 * @return string
 */
function clear_hl_session_token() {
    $current_user = wp_get_current_user();
    token_disconnect();
    delete_option("hl_session_token");
}
add_action('wp_logout', 'clear_hl_session_token');

/**
 * Check user session and logout if not valid
 *
 * @since v.1.0
 *
 * @return string
 */
add_action( 'parse_request', 'wpa_check_token' ,1);
function wpa_check_token(){
    if ( is_user_logged_in() ) {
        $message   = "";
        $response  = session_lookup();
        if ( ! $response->session_token ){
    	    wp_logout();
        }
    }
}

add_action( 'wp_logout', 'wpa_logout_redirect' ,1);
function wpa_logout_redirect(){
    wp_redirect(home_url());
    exit();
}

/**
 * Automatically logs in a user with the correct nonce
 *
 * @since v.1.0
 *
 * @return string
 */
add_action( 'init', 'wpa_autologin_via_url' ,1);
function wpa_autologin_via_url(){
	if( isset( $_GET['token'] ) || isset( $_POST['token'] ) ){
		$value = sanitize_text_field( $_POST['token'] );
		$token     =  isset($_REQUEST['token'])? $_REQUEST['token']: $value;
		$message   = "";
		$current_page_url = remove_query_arg("token",wpa_curpageurl());
		$response  = token_confirm($token,$message);

        if ( ! $response ){
			wp_redirect( $current_page_url . '?wpa_error_token=true&message='.$message );
			exit;
		} 
		else 
		{	
		    if( wpa_valid_account($response->email) )
		    {
		    	$user = get_user_by( 'email', $response->email );
		    }	
		    else
		    {
		    	$user = create_new_user($response);

		    }	
		    $uid = $user->ID;
		    wp_set_auth_cookie( $uid );
			delete_user_meta($uid, 'wpa_' . $uid );
			delete_user_meta($uid, 'wpa_' . $uid . '_expiration');
			$total_logins = get_option( 'wpa_total_logins', 0);
			update_option( 'wpa_total_logins', $total_logins + 1);
			update_option( 'hl_session_token', $response->session_token);
			wp_redirect( site_url() );
			exit();		
		}
	}
}

function create_new_user($response){
  	$user_email = $response->email;
  	$user_id = username_exists( $user_email );
	if ( !$user_id and email_exists($user_email) == false ) {
	$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
	$user_id = wp_create_user( $user_email, $random_password, $user_email );
	} else {
	$random_password = __('User already exists.  Password inherited.');
	}
  	//Set the nickname
  	wp_update_user(
	    array(
	      'ID'          =>    $user_id,
	      'nickname'    =>    $email_address
	    )
  	);

  	// Set the role
  	$user = new WP_User( $user_id );
  	return $user;
}

/**
 * Returns the current page URL
 *
 * @since v.1.0
 *
 * @return string
 */
function wpa_curpageurl() {
	$pageURL = 'http';

	if ((isset($_SERVER["HTTPS"])) && ($_SERVER["HTTPS"] == "on"))
		$pageURL .= "s";

	$pageURL .= "://";

	if ($_SERVER["SERVER_PORT"] != "80")
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	else
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

	return $pageURL;
}
