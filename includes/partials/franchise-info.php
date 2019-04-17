<?php
	if (isMainSite() === FALSE && $post->post_name !== 'contact') {
		echo '<section class="franchise-info">';
		echo '<div>';
		echo '<h5>Request Franchise Info</h5>';
		echo '<p><a class="button-white" href="' . esc_url(home_url('/contact')) . '">Franchise Info <i class="icon icon-angle-right"></i></a></p>';
		echo '</div>';
		echo '</section>';
	}
