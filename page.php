<?php
	get_header();

	if (have_posts()):
	while (have_posts()):
	the_post();
?>

<section class="layout-text">
	<article>
		<?php
			if ($post->post_name == 'opportunities') {
				echo '<p><img src="' . get_bloginfo('template_directory') . '/assets/img/map.svg" /></p>';
			}
		?>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</article>
</section>

<?php
	endwhile;
	endif;

	get_footer();
?>