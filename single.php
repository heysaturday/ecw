<?php
	get_header();

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

	get_footer();
?>