<?php
/**
 * Template Name: Home (Main)
 */

get_header();

if (isMainSite()):
$location = getNearestLocation();
?>

<?php get_template_part('includes/partials/wing-builder'); ?>

<section class="home-callout">
	<div>
		<h2>#1 in Franchisee Satisfaction</h2>
		<p><a class="button-black" target="_blank" href="http://eastcoastwingsfranchise.com/">Franchise Opportunities</a></p>
	</div>
</section>

<section class="home-main-sections">
	<article>
		<h2><i class="icon icon-map-marker"></i>Selected Location (<a href="<?php echo esc_url(home_url('/location')); ?>">Change</a>) <strong><?php echo $location['name']; ?></strong></h2>
		<h3><?php echo $location['address_1']; ?></h3>
		<p><a class="button-black" href="<?php echo $location['permalink']; ?>">Store Info <i class="icon icon-angle-right"></i></a></p>
	</article>
	<article>
		<h2><i class="icon icon-cutlery"></i>Check out our <strong>menu</strong></h2>
		<h3>&nbsp;</h3>
		<p><a class="button-black" href="<?php echo get_permalink(get_page_by_path('menu')); ?>">See Our Menu <i class="icon icon-angle-right"></i></a></p>
	</article>
</section>

<?php

	// Flavor of the Month
	get_template_part('includes/partials/flavor-of-the-month');

	// Promos
	$query = new WP_Query(array(
		'post_type'			=> 'promo',
		'posts_per_page'	=> -1
	));
	if ($query->have_posts()) {
		echo '<section class="promos">';
		while ($query->have_posts()) {
			$query->the_post();
			$promoLocation = get_field('locations');
			if (empty($promoLocation) || in_array($location['id'], $promoLocation, TRUE)) {
				get_template_part('includes/partials/card-promo');
			}
		}
		echo '</section>';
	}
	wp_reset_query();



else:

		if (have_posts()):
			while (have_posts()):
			the_post();
		?>

		<section class="layout-text">
			<article>
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</article>
		</section>

		<?php
			endwhile;
			endif;

endif;
?>

<section class="home-footer">
	<div class="home-news">
		<?php
			// News
			$query = new WP_Query(array(
				'meta_key'			=> 'featured',
				'meta_value'		=> TRUE,
				'post_type'			=> 'post',
				'posts_per_page'	=> 1
			));
			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					get_template_part('includes/partials/card-post');
				}
			}
			wp_reset_query();
		?>
	</div>
	<article class="home-app">
		<?php get_template_part('includes/partials/app-info'); ?>
	</article>
</section>

<?php get_footer(); ?>