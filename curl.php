<?php 

class RestApiRequestResponse
{
	var $url;
	var $email;
	var $created;
	function __construct()
	{
		
	}
}
class RestApiConfirmResponse
{
	var $url;
	var $email;
	var $created;
	var $session_token;
	function __construct()
	{
		
	}
}
class RestApiDisconnectResponse
{
	var $url;
	var $email;
	var $created;
	var $provider_id;
	function __construct()
	{

	}
}
class RestApiSessionResponse
{
	var $url;
	var $email;
	var $created;
	var $session_token;
	function __construct()
	{

	}
}

function get_the_user_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return apply_filters( 'wpb_get_ip', $ip );
}

function make_api_call($array, $endpoint) {
    $aToken = get_option("restautoken");
	if(empty($aToken)){
		return false;
	}
	try
	{	
		$result = wp_remote_post("https://75b7-173-69-176-100.ngrok.io/".$endpoint."/", array(
		  'method' => 'POST',		  
		  'headers'   => [
            'Content-type' => 'application/x-www-form-urlencoded',
            'Accept'     => '*/*',
            'User-Agent' => 'runscope/0.1',
            'Accept-Encoding' => 'gzip, deflate',
            'Authorization' => 'Token '.$aToken
        	],
		  'body' => $array		  
		 ));

		if ( is_wp_error( $result ) ) {
		    $error_message = $result->get_error_message();
		    return false;
		} 
		return json_decode($result['body']);
	}
	catch(Exception $ex){
		$message = $ex->getMessage();
		return false;
	}
}

add_shortcode('show_ip', 'get_the_user_ip');

function token_request($email,&$message){

	$array = array(
        	'email' => $email,
        	'ip' => get_the_user_ip()
    		);
	$result = make_api_call($array, "tokenrequest");
	return $result;	
}

function token_confirm($token,&$message){

	$array = array(
        	'token' => $token,
        	'ip' => get_the_user_ip()
    		);
	$result = make_api_call($array, "tokenconfirm");
	return $result;
}

function token_disconnect(){

	$session_token = get_option("hl_session_token");
	$array = array(
        	'session_token' => $session_token,
        	'ip' => get_the_user_ip()
    		);
	$result = make_api_call($array, "disconnect");
	return $result;
}

function session_lookup(){

	$session_token = get_option("hl_session_token");
	$array = array(
        	'session_token' => $session_token,
        	'ip' => get_the_user_ip()
    		);
	$result = make_api_call($array, "session");
	return $result;
}