<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">HugeLogin Settings</h3>
	</div>
	<div class="panel-body">
		<form method="post" action="">
			<div class="form-group">
				<label for="restautoken">Authorization Token</label>
				<input type="text" class="form-control" name="restautoken" id="restautoken" value="<?php echo get_option("restautoken");?>">
			</div>
			<div class="form-group">
				<label for="restautoken">Login Options</label>
			</div>
			<div class="form-group">
				<label>
					<input type="radio" name="rest_api_form_options" id="rest_api_form_use_both" 
					<?php if ( get_option("rest_api_form_options") == "use_both") echo "checked"?> value="use_both">
					Use WordPress and HugeLogin
				</label>
			</div>
			<div class="form-group">
				<label>
					<input type="radio"  name="rest_api_form_options" id="rest_api_form_use_classic" 
					<?php if ( get_option("rest_api_form_options") == "use_classic") echo "checked"?> value="use_classic">
					Use WordPress only
				</label>
			</div>
			<div class="form-group">
				<label>
					<input type="radio" name="rest_api_form_options" id="rest_api_form_use_api" 
					<?php if ( get_option("rest_api_form_options") == "use_api") echo "checked"?> value="use_api">
					Use HugeLogin only
				</label>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Save</div>
			</div>
			
		</form>
		<div class="clear"></div>
	</div>
</div>