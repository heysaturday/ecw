<div id="change-location" data-url="<?php echo (is_archive()) ? get_post_type_archive_link('location') : get_permalink(); ?>">
	<h2>Change Location</h2>
	<div>
		<div>
			<p class="option"><button class="button-white">Use Current Location</button></p>
			<p class="or">or</p>
			<form novalidate="novalidate">
				<input type="text" maxlength="5" placeholder="Enter Zip" />
				<button>Submit</button>
			</form>
		</div>
	</div>
	<i class="loader"></i>
</div>
