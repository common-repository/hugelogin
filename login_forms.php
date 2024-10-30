<form name="wpaloginform" id="wpaloginform" action="" method="post">
	<div class="form-group" style="padding-bottom:10px;">
		<label for="user_email_username"><?php _e('Email Address') ?></label>
		<input type="email" placeholder="john@doe.com" required name="user_email_username" id="user_email_username" class="form-control input-large" value="<?php echo esc_attr( $account ); ?>" size="25" />
	</div>
	<div class="form-group col-md-8">
		<label>  
			<input type="checkbox" name="remember_me" id="remember_me" class="form-input" <?php if(isset($_POST['remember_me'])) echo "checked";?>>
			Remember Me		
		</label>
	</div>
	<div class="col-md-4">
		<input type="submit" name="wpa-submit" id="wpa-submit" class="button-primary" value="<?php esc_attr_e('Connect'); ?>" />
	</div>				
	
	<?php wp_nonce_field( 'wpa_restapi_login_request', 'nonce', false ) ?>
</form>