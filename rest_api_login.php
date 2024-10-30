<?php 

define("WP_LOGIN_URL", plugin_dir_url(__FILE__)."wp_login.php");
define("RESTAPI_LOGIN_VERSION", "1.0");

function isTokenLogin($page_viewed){
    $request = explode("login/?token=", $page_viewed);
    if(count($request) > 1){
        return $request[1];
    }
    else
    {
        return false;
    }
}

function isLoginPage(){
    $pageviewed = basename($_SERVER['REQUEST_URI']);
    $request = explode("wp-login.php", $pageviewed);
    $error_token = explode("wpa_error_token", $pageviewed);

    if(count($request) > 1 || count($error_token) > 1){
        return $pageviewed;
    }
    else
    {
        return false;
    }
}

function redirect_login_page() {
    if(isset($_GET['action']) && $_GET['action'] = 'logout'){
        return;        
    }
    $full_request  = $_SERVER['REQUEST_URI'];
    $token_r_page  =  isTokenLogin($full_request);
    $query_args    = isLoginPage(); 
    if( $query_args || $token_r_page) {
   if(get_option("rest_api_form_options") == "use_both" || get_option("rest_api_form_options") == "use_api" ){
           wpa_front_end_login();
            
            exit();
     }    
    }
}
add_action( 'login_form_middle', 'add_lost_password_link' );

function add_lost_password_link() {
	return '<a href="/wp-login.php?action=lostpassword">Lost Password?</a>';
}
add_action('init','redirect_login_page',2);

function login_failed() {
    wp_redirect( WP_LOGIN_URL . '?login=failed' );
    exit;
}
//add_action( 'wp_login_failed', 'login_failed' );
 
function verify_username_password( $user, $username, $password ) {
    //$login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( WP_LOGIN_URL . "?login=empty" );
        exit;
    }
}
//add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
    wp_redirect( WP_LOGIN_URL . "?login=false" );
    exit;
}
//add_action('wp_logout','logout_page');