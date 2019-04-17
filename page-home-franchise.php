<?php
/**
 * Template Name: Home (Franchise)
 */

get_header();

if (isMainSite()):

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

else:

		if (have_posts()):
			while (have_posts()):
			the_post();
		?>

			<?php
				$image = get_field('hero_image');
				$image = ($image['sizes'] && $image['sizes']['large']) ? $image['sizes']['large'] : '';
				$position = get_field('hero_image_position');
			?>
			<section class="home-franchise-hero" style="background-image:url('<?php echo $image; ?>'); background-position:<?php echo $position; ?>; background-repeat:no-repeat;">
				<div>
					<?php echo widont(get_field('hero_text')); ?>
				</div>
			</section>

			<?php get_template_part('includes/partials/franchise-info'); ?>

			<section class="layout-image-right franchise-homepage">
				<?php
					$image = get_field('image');
					$image = ($image['sizes'] && $image['sizes']['large']) ? $image['sizes']['large'] : '';
					$position = get_field('image_position');
				?>
				<div class="image" style="background-image:url('<?php echo $image; ?>'); background-position:<?php echo $position; ?>;"></div>
				<article class="align-left">
					<?php the_content(); ?>
				</article>
			</section>

		<?php
			endwhile;
			endif;

endif;
?>

<?php get_footer(); ?>