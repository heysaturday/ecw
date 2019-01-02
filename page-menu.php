<?php
/**
 * Template Name: Menu
 */

get_header();
?>

<section class="layout-menu">
	<?php
        $images = get_field('images');
        $image = '';
        $position = '';
        if ($images) {
            $key = rand(0, count($images)-1);
            $image = $images[$key]['image'];
            $position = $images[$key]['image_position'];
        }
    ?>
	<div class="image" style="background-image:url('<?php echo $image; ?>'); background-position:<?php echo $position; ?>;"></div>
	<div class="content" id="menu-content">

		<?php

            $doNotShow = array('Extras', 'One Wing Sample', 'The Magnificent Flavors');
            if ($_GET && $_GET['l']) {
                $location = getLocation($_GET['l']);
            } else {
                $location = getNearestLocation();
            }
          $selected_location = getNearestLocation();
          if ($selected_location != $location['id'] && ($location["olo_url"] || $location["door_dash_id"])) {
              echo "<h2 style='margin-bottom:10px;'>Menu for <a href=" . $location["permalink"] . ">" . $location["title"] . "</a></h2><div style='margin:10px auto; text-align:center;'>";
          } else {
              echo "<h2>Menu for <a href=" . $location["permalink"] . ">" . $location["title"] . "</a></h2><div style='margin:10px auto; text-align:center;'>";
          }


                        if ($selected_location['id'] == $location['id']) {
                            if ($location['olo_url'] || $location['door_dash_id']) {
                                echo "<div style='margin-bottom:60px;'>";
                                if ($location['door_dash_id']) {
                                    echo '
<a style="margin-bottom:10px; min-width:200px;" class="button-orange" href="https://www.doordash.com/store/' . $location['door_dash_id'] . '/?utm_source=partner-link&utm_medium=website&utm_campaign=' . $location['door_dash_id'] . '" target="_blank">Order for Delivery <i class="icon icon-angle-double-right"></i></a>';
                                }
                                if (get_field('order_online_url', 'option')) {
                                    echo '
<a style="margin-bottom:10px; min-width:200px;" class="button-orange" href="', $location['olo_url'] ? $location['olo_url'] : the_field('order_online_url', 'option'), '" target="_blank">Order for Pickup <i class="icon icon-angle-double-right"></i></a></div>';
                                }
                                echo "</div>";
                            }
                        } else {
                            echo '<div style="margin-bottom:60px;"><a style="margin-bottom:10px; min-width:200px;" class="button-orange" href="' . get_post_type_archive_link('location') . '?latitude=' . $location['latitude'] . '&longitude=' . $location['longitude'] . '">Make Selected Location <i class="icon icon-angle-right"></i></a></div>';
                        }




            $menu = getMenuForLocation($location['id']);

            $nav = '';
            $content = '';


            // Static Wings Section
            $wingsTitle = 'America’s Best Wings';
            $nav .= '<li id="menu-nav-' . slugify($wingsTitle) . '"><span data-value="' . slugify($wingsTitle) . '"><em>' . $wingsTitle . '</em></span></li>';
            $content .= '<article id="menu-group-' . slugify($wingsTitle) . '" class="menu-group">';
            $content .= '<h3 data-value="' . slugify($wingsTitle) . '"><em>' . $wingsTitle . '</em></h3>';
            $content .= '<div>';
                $content .= '<div class="wing-selection">
					<h5><em>1</em> Select Wing Type</h5>
					<div>
						<ul class="wing-types">
							<li><strong>Buffalo Mix™</strong> combination of traditional and boneless wings</li>
							<li><strong>Boneless</strong></li>
							<li><strong>Traditional</strong></li>
						</ul>
					</div>
					<h5><em>2</em> Select Quantity</h5>
					<div>
						<p>Buffalo Mix™ only available in increments of 10, 15, and 25.</p>
						<ul class="prices">';
                        $price = get_field('wing_quantities_prices', $location['id']);
                        if (empty($price)) {
                            $price = get_field('wing_quantities_prices', 'option');
                        }
                        if (!empty($price)) {
                            foreach ($price as $row) {
                                $content .= '<li><strong>' . $row['quantity'] . '</strong> ' . $row['price'] . '</li>';
                            }
                        }
                        $content .= '</ul>
						<p><strong>Prices may change by market, check with your local store for accurate pricing.</strong></p>
					</div>
					<h5><em>3</em> Select Wing Flavor</h5>
					<div>
						<p>Each flavor is mixed to order with the freshest ingredients and our nationally award winning wing sauce. All flavors can be mixed with a heat index of your choice.</p>
						<p><strong>Add one flavor to your wings for FREE for up to 15 wings. Quantities 25 and above will receive 2 FREE flavors.</strong> Additional Flavors are .99.</strong></p>
					</div>
					<h5><em>4</em> Select Heat Index</h5>
					<div>
						<p>How hot can you take it? Select your preferred wing heat using the Scoville scale below on the next page. From “Virgin” to “Insanity,” pick what you like. We won’t judge!</p>
						<p><a class="heat-indexes-link" href="#heat-indexes">View our Heat Indexes below.</a></p>
					</div>
				</div>';

                $flavorCategories = get_terms('flavor-category', array(
                    'hide_empty'	=> true,
                    'order'			=> 'ASC',
                    'orderby'		=> 'name'
                ));
                if (!empty($flavorCategories)) {
                    $content .= '<div>
						<h4 class="fancy-header"><em>Flavors</em></h4>
						<div class="flavor-container">';
                    foreach ($flavorCategories as $category) {
                        $query = new WP_Query(array(
                                'order' => 'ASC',
                                'orderby' => 'title',
                                'post_type' => 'flavor',
                                'taxonomy' => 'flavor-category',
                                'term' => $category->slug,
                                'showposts' => -1
                            ));
                        if (!empty($query)) {
                            $content .= '<div class="flavor" id="flavor-group-' . slugify($category->name) . '">';
                            $content .= '<h5 data-id="flavor-group-' . slugify($category->name) . '"><em><i class="icon icon-plus"></i><i class="icon icon-minus"></i>' . $category->name . '</em></h5>';
                            $content .= '<ul>';
                            while ($query->have_posts()) {
                                $query->the_post();
                                $flavorLocation = get_field('locations');
                                if (empty($flavorLocation) || in_array($location['id'], $flavorLocation, true)) {
                                    $content .= '<li><h6 style="color:' . get_field('color') . ';">' . get_the_title() . '</h6>';
                                    $content .= get_field('description');
                                    $content .= '</li>';
                                }
                            }
                            wp_reset_postdata();
                            $content .= '</ul>';
                            $content .= '<p>Add one flavor to your wings for FREE for up to 15 wings. Quantities 25 and above will receive 2 FREE flavors. Additional Flavors are .99.</p>';
                            $content .= '</div>';
                        }
                    }
                    $content .= '</div>
					</div>';
                }

                $heatIndexes = get_field('heat_indexes', 'option');
                if (!empty($heatIndexes)) {
                    $content .= '<div id="heat-indexes">
						<h4 class="fancy-header"><em>Heat Indexes</em></h4>
						<div>
							<ul class="heat-indexes">';
                    foreach ($heatIndexes as $heat) {
                        $content .= '<li style="background-color:' . $heat['color'] . ';">' . $heat['name'] . '</li>';
                    }
                    $content . '</ul>
						</div>
					</div>';
                }
            $content .= '</div>';
            $content .= '</article>';


            if ($menu && $menu['data'] && $menu['data']['menus']) {
                foreach ($menu['data']['menus'] as $row) {
                    if ($row['name'] === "America's Best Wings" || $row['name'] === 'Main Menu' || $row['name'] === 'Lunch Menu') {
                        if ($row['sections']) {
                            foreach ($row['sections'] as $section) {
                                if ($section['items']) {
                                    if (in_array($section['name'], $doNotShow) === false) {
                                        $nav .= '<li id="menu-nav-' . slugify($section['name']) . '"><span data-value="' . slugify($section['name']) . '"><em>' . $section['name'] . '</em></span></li>';
                                        $content .= '<article id="menu-group-' . slugify($section['name']) . '" class="menu-group">';
                                        $content .= '<h3 data-value="' . slugify($section['name']) . '"><em>' . $section['name'] . '</em></h3>';
                                        if ($section['description']) {
                                            $content .= '<p>' . $section['description'] . '</p>';
                                        }
                                        $content .= '<div class="columns">';
                                        foreach ($section['items'] as $item) {
                                            $content .= '<div>';

                                            $price = '';
                                            $attributes = '';
                                            if ($item['choices']) {
                                                foreach ($item['choices'] as $choice) {
                                                    if ($choice['prices'] && ($choice['prices']['max'] || $choice['prices']['min'])) {
                                                        $price = ' <em>';
                                                        if ($choice['prices']['min']) {
                                                            $price .= money_format('%.2n', $choice['prices']['min']);
                                                        }
                                                        if ($choice['prices']['max'] && $choice['prices']['min']) {
                                                            $price .= '-';
                                                        }
                                                        if ($choice['prices']['max']) {
                                                            $price .= money_format('%.2n', $choice['prices']['max']);
                                                        }
                                                        $price .= '</em>';
                                                    }
                                                    if ($choice['name']) {
                                                        $attributes .= '<li>' . $choice['name'];
                                                        if ($price) {
                                                            $attributes .= $price;
                                                        }
                                                        $attributes .= '</li>';
                                                    }
                                                }
                                            }

                                            $itemName = $item['name'];
                                            $itemName = str_replace('*', '', $itemName);
                                            $itemName = str_replace('#', '', $itemName);
                                            $itemName = trim($itemName);
                                            if ($attributes) {
                                                $content .= '<h4>' . $itemName . '</h4>';
                                            } else {
                                                $content .= '<h4>' . $itemName . $price . '</h4>';
                                            }
                                            if ($item['description']) {
                                                $content .= '<p>' . $item['description'] . '</p>';
                                            }
                                            if ($attributes) {
                                                $content .= '<ul>' . $attributes . '</ul>';
                                            }

                                            $content .= '</div>';
                                        }
                                        $content .= '</div>';
                                        $content .= '</article>';
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($nav) {
                echo '<div class="menu-nav"><ul>' . $nav . '</ul></div>';
                echo '<div class="menu-content">' . $content;
                if (get_field('disclaimer')) {
                    echo '<div class="disclaimer"><p><em>' . get_field('disclaimer') . '</em></p></div>';
                }
                echo '</div>';
            } else {
                echo '<p class="no-content">No menu items found.</p>';
            }

            //echo '<pre><code>';
            //print_r($menu);
            //echo '</code></pre>';

        ?>
	</div>
	<?php get_template_part('includes/partials/flavor-of-the-month'); ?>
</section>

<?php get_footer(); ?>
