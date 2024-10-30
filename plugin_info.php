<div class="wrap wpa-wrap wpa-info-wrap">
	<div class="wpa-badge <?php echo "HugeLogin"; ?>"><?php printf( __( 'Version %s' ), RESTAPI_LOGIN_VERSION ); ?></div>
		<h1><?php printf( __( '<strong>HugeLogin</strong> <small>v.</small>%s', 'restapi_auth' ), RESTAPI_LOGIN_VERSION ); ?></h1>
		<p class="wpa-info-text"><?php printf( __( 'Password free login for Wordpress.', 'restapi_auth' ) ); ?></p>
		<p><strong style="font-size: 30px; vertical-align: middle; color:#d54e21;"><?php echo esc_attr( get_option('wpa_total_logins', '0') ); ?></strong> successful logins without passwords.</p>
		<hr />
		<h2 class="wpa-callout"><?php _e( 'Password free login for Wordpress', 'restapi_auth' ); ?></h2>
		<div class="wpa-row wpa-2-col">
			<div>
				<h3><?php _e( '[restapi_auth-login] shortcode', 'restapi_auth' ); ?></h3>
				<p><?php _e( 'Just enter <strong class="nowrap">[restapi_auth-login]</strong> your email address and you are good to go.', 'restapi_auth' ); ?></p>
			</div>
			<div>
				<h3><?php _e( 'An alternative to passwords', 'restapi_auth'  ); ?></h3>
				<p><?php _e( 'HugeLogin is the beginning of the end for passwords. Available for millions of Wordpress and non-Wordpress based websites and apps, you can manage all of your connections from one place.', 'restapi_auth' ); ?></p>
			</div>
		</div>
		<hr/>
		<div>
			<h3><?php _e( 'Take control of the login and registration process with HugeLogin', 'restapi_auth' );?></h3>
			<p><?php _e( 'This plugin is based on REST API Authentication: <a href="http://solvepapers.com/plugins/REST_API_Athentication/">REST API Authentication in WP</a>', 'restapi_auth' ); ?></p>
			<div class="wpa-row wpa-3-col">
				<div><p><?php _e('Front-End registration, edit profile and login forms.', 'restapi_auth'); ?></p></div>
				<div><p><?php _e('Drag and drop to reorder / remove default user profile fields.', 'restapi_auth'); ?></p></div>
				<div><p><?php _e('Allow users to log in with their email or token', 'restapi_auth'); ?></p></div>
				<div><p><?php _e('Enforce minimum password length and minimum password strength.', 'restapi_auth'); ?></p></div>
			</div>
			<p><a href="http://www.solvepapers.com/" class="button button-primary button-large"><?php _e( 'Learn More About <a href="http://www.hugelogin.com/">HugeLogin</a>', 'restapi_auth' ); ?></a></p>
		</div>
	</div>