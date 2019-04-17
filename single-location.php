<?php
    get_header();

    if (have_posts()):
    while (have_posts()):
    the_post();

    $location = getNearestLocation();
?>

<section class="layout-location">

	<div class="location-info">

		<?php if (get_the_ID() == $location['id']): ?>
			<p class="nearest-text"><span>Selected Location</span> (<a href="<?php echo esc_url(home_url('/location')); ?>">Change</a>):</p>
		<?php endif; ?>
		<div class="address">
			<h2><?php echo (get_field('name')) ? get_field('name') : get_field('city'); ?></h2>
			<?php
                echo '<p>';
                echo get_field('address_1') . ', ';
                if (get_field('address_2')) {
                    echo get_field('address_2') . ', ';
                }
                echo get_field('city') . ', ';
                echo get_field('state') . ' ';
                echo get_field('postal_code');
                echo '</p>';
            ?>
		</div>

		<?php
            $menu = getMenuForLocation(get_the_ID());

            // Image
            $image = get_field('image');
            $image = ($image['sizes'] && $image['sizes']['thumbnail']) ? $image['sizes']['thumbnail'] : false;
            if ($image) {
                echo '<p class="image"><img src="' . $image . '" /></p>';
            }

            // Hours
            if ($menu && $menu['data'] && $menu['data']['location'] && $menu['data']['location']['hours']) {
                $hours = $menu['data']['location']['hours'];
                $days = array('Mon'=>'Monday', 'Tue'=>'Tuesday', 'Wed'=>'Wednesday', 'Thu'=>'Thursday', 'Fri'=>'Friday', 'Sat'=>'Saturday', 'Sun'=>'Sunday');
                echo '<ul class="hours">';
                foreach ($days as $abbr => $day) {
                    if ($hours[$day] && $hours[$day][0] && $hours[$day][0]['opening'] && $hours[$day][0]['closing']) {
                        echo '<li><strong>' . $abbr . '</strong> ' . ltrim(str_replace(':00', '', $hours[$day][0]['opening']), '0') . ' - ' . ltrim(str_replace(':00', '', $hours[$day][0]['closing']), '0') . '</li>';
                    } else {
                        echo '<li><strong>' . $abbr . '</strong> Closed</li>';
                    }
                }
                echo '</ul>';
            }


//Phone Number Override


    //$phone_number = get_field('phone_number');

     //if(get_field('phone_number')) {

    //echo '<p class="phone"><a href="tel:+1' . str_replace('-', '', $phone_number) . '"><i class="icon icon-phone"></i>' . $phone_number . '</a>';
    //echo '</p>';} else {



            // Phone

            if ($menu && $menu['data'] && $menu['data']['location'] && $menu['data']['location']['phone']) {
                $phone = $menu['data']['location']['phone'];
                echo '<p class="phone"><a href="tel:+1' . str_replace('-', '', $phone) . '"><i class="icon icon-phone"></i>' . $phone . '</a></p>';
            }
        //}
        ?>

		<ul class="links">
			<?php if (get_the_ID() != $location['id']): ?>
				<li><a class="button-yellow" href="<?php the_permalink(); ?>?latitude=<?php the_field('latitude'); ?>&longitude=<?php the_field('longitude'); ?>">Make Selected Location <i class="icon icon-angle-right"></i></a></li>
			<?php endif; ?>
			<li><a class="button-orange" href="<?php echo get_permalink(get_page_by_path('menu')); ?>?l=<?php the_ID(); ?>">See Menu <i class="icon icon-angle-right"></i></a></li>
				<li><a class="button-orange-alt" href="https://www.google.com/maps/dir/Current+Location/<?php echo urlencode('East Coast Wings ' . get_the_title()); ?>+<?php the_field('latitiude'); ?>,<?php the_field('longitude'); ?>" target="_blank">Click for Directions <i class="icon icon-angle-double-right"></i></a></li>
		</ul>
		<ul class="social">
			<li><a href="<?php echo (get_field('facebook_url')) ? get_field('facebook_url') : get_field('facebook_url', 'option'); ?>" target="_blank"><i class="icon icon-facebook"></i></a></li>
			<li><a href="<?php echo (get_field('twitter_url')) ? get_field('twitter_url') : get_field('twitter_url', 'option'); ?>" target="_blank"><i class="icon icon-twitter"></i></a></li>
			<li><a href="<?php echo (get_field('instagram_url')) ? get_field('instagram_url') : get_field('instagram_url', 'option'); ?>" target="_blank"><i class="icon icon-instagram"></i></a></li>
		</ul>

	</div>

	<div class="map-container">
<!--<div id="map" class="map" data-link="https://www.google.com/maps/dir/Current+Location/<?php echo urlencode('East Coast Wings ' . get_the_title()); ?>" data-latitude="<?php the_field('latitude'); ?>" data-longitude="<?php the_field('longitude'); ?>"></div>-->
		<iframe class="map" src="https://www.google.com/maps/embed/v1/place?key=<?php the_field('api_key', 'option'); ?>&q=<?php echo urlencode('East Coast Wings ' . get_the_title()); ?>+<?php the_field('latitiude'); ?>,<?php the_field('longitude'); ?>" frameborder="0" style="border:0"></iframe>

	</div>


</section>

<?php
    // Specials
    function showSpecials($menu, $type='Daily Specials')
    {
        if ($menu && $menu['data'] && $menu['data']['menus']) {
            foreach ($menu['data']['menus'] as $row) {
                if ($row['name'] == $type) {
                    if ($row['sections']) {
                        echo '<section class="specials">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<div>';
                        foreach ($row['sections'] as $section) {
                            if ($section['items']) {
                                foreach ($section['items'] as $item) {
                                    if (substr_count($item['name'], '.') >= 2) {
                                        $segs = explode('. ', $item['name']);
                                        echo '<div class="fancy">';
                                        echo '<h6>' . $segs[0] . '</h6>';
                                        echo '<p>' . trim(str_replace($segs[0].'. ', '', $item['name'])) .'</p>';
                                    } else {
                                        echo '<div>';
                                        echo '<h6>' . $item['name'] . '</h6>';
                                    }
                                    echo '<ul>';
                                    if ($item['description']) {
                                        echo '<li>' . $item['description'] . '</li>';
                                    }
                                    if ($item['additions']) {
                                        foreach ($item['additions'] as $addition) {
                                            echo '<li>' . $addition['name'];
                                            if ($addition['prices'] && ($addition['prices']['max'] || $addition['prices']['min'])) {
                                                echo ' <em>';
                                                if ($addition['prices']['min']) {
                                                    echo money_format('%.2n', $addition['prices']['min']);
                                                }
                                                if ($addition['prices']['max'] && $addition['prices']['min']) {
                                                    echo '-';
                                                }
                                                if ($addition['prices']['max']) {
                                                    echo money_format('%.2n', $addition['prices']['max']);
                                                }
                                                echo '</em>';
                                            }
                                            echo '</li>';
                                        }
                                    }
                                    echo '</ul>';
                                    echo '</div>';
                                }
                            }
                        }
                        echo '</div>';
                        echo '</section>';
                    }
                }
            }
        }
    }
    showSpecials($menu, 'Daily Specials');

?>



<?php
    $location_id = get_the_ID();
    $query = new WP_Query(array(
        'post_type'			=> 'promo',
        'posts_per_page'	=> -1
    ));
    if ($query->have_posts()) {
        echo '<section class="promos">';
        while ($query->have_posts()) {
            $query->the_post();
            $promoLocation = get_field('locations');
            if (empty($promoLocation) || in_array($location_id, $promoLocation, true)) {
                get_template_part('includes/partials/card-promo');
            }
        }
        echo '</section>';
    }
    wp_reset_query();
?>

<?php
    endwhile;
    endif;

    get_footer();
?>
