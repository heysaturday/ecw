<?php
/**
 * Template Name: Image on Right
 */

get_header();
?>

<section class="layout-image-right">
	<?php
		$image = get_field('image');
		$image = ($image['sizes'] && $image['sizes']['large']) ? $image['sizes']['large'] : '';
		$position = get_field('image_position');
	?>
	<div class="image" style="background-image:url('<?php echo $image; ?>'); background-position:<?php echo $position; ?>;"></div>
	<article<?php echo (isMainSite() === FALSE) ? ' class="align-left"' : ''; ?>>
		<?php
			if ($post->post_name == 'rewards') {

				echo '<h2 class="rewards-header">Our guests love us, we&nbsp;love&nbsp;them back.</h2>';

				echo '<div class="rewards">';
				echo '<i class="card"></i>';
				echo '<div>';
				echo '<h2>' . get_the_title() . '</h2>';
				the_content();
				echo '</div>';
				echo '</div>';

				/*
				echo '<div class="app-info">';
				echo '<i class="phone"></i>';
				echo '<div>';
				get_template_part('includes/partials/app-info');
				echo '</div>';
				echo '</div>';
				*/

			} else {
		?>
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
		<?php
			}
		?>
	</article>
</section>

<?php get_footer(); ?>