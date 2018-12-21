<?php get_header(); ?>

<section class="layout-locations">
	<h2>Selected Location</h2>
	<?php
		$locations = getLocationsOrderedByNearest();
		if (!empty($locations)) {
			foreach ($locations as $number => $location) {
				echo '<article';
				if ($number == 0) {
					echo ' class="closest"';
				}
				echo '>';
				echo '<h3>' . ($number + 1) . '</h3>';
				echo '<div>';
				echo '<h4><a href="' . $location['permalink'] . '">' . $location['name'] . '</a></h4>';
				echo '<p>' . $location['address_1'] . ', ';
				if ($location['address_2']) {
					echo $location['address_2'] . ', ';
				}
				echo $location['city'] . ',&nbsp;' . $location['state'] . '&nbsp;' . $location['postal_code'] . '</p>';
				echo '</div>';
				echo '<ul>';
				echo '<li><a class="button-orange" href="' . $location['permalink'] . '">Store Info <i class="icon icon-angle-right"></i></a></li>';
				if ($number > 0) {
					echo '<li><a class="button-yellow" href="' . get_post_type_archive_link('location') . '?latitude=' . $location['latitude'] . '&longitude=' . $location['longitude'] . '">Make Selected Location <i class="icon icon-angle-right"></i></a></li>';
				}
				echo '</ul>';
				echo '</article>';
				if ($number == 0) {
					get_template_part('includes/partials/change-location');
					echo '<h2>Other Locations</h2>';
				}
			}
		}
	?>
</section>


<?php get_footer(); ?>