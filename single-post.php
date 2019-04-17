<?php
	get_header();

	if (have_posts()):
	while (have_posts()):
	the_post();
?>

<section class="layout-news">
	<?php if (isMainSite()): ?>
		<h2><a href="<?php echo esc_url(home_url('/news')); ?>">East Coast, Worldwide<br/><span>ECW+G News</span></a></h2>
	<?php else: ?>
		<h2><a href="<?php echo esc_url(home_url('/news')); ?>">News</a></h2>
	<?php endif; ?>
	<div class="news-main">
		<article class="card-post">
			<div class="image"><a href="<?php the_permalink(); ?>"><?php
				$image = get_field('image');
				$image = ($image['sizes'] && $image['sizes']['thumbnail']) ? $image['sizes']['thumbnail'] : get_template_directory_uri().'/assets/img/flame.jpg';
				if ($image) {
					echo '<img src="' . $image . '" />';
				}
			?><span><?php echo get_post_time('m/d/Y', TRUE); ?></span></a></div>
			<div class="info">
				<h3><?php the_title(); ?></h3>
				<?php the_content(); ?>
				<?php if (isMainSite()): ?>
					<p><a class="button-orange" href="<?php echo esc_url(home_url('/news')); ?>"><i class="icon icon-angle-left"></i> Back to News</a></p>
				<?php else: ?>
					<p><a class="button-orange" href="<?php echo esc_url(home_url('/news')); ?>"><i class="icon icon-angle-left"></i> Back to News</a></p>
				<?php endif; ?>
			</div>
		</article>
	</div>
	<div class="news-side">
		<?php get_search_form(); ?>
		<?php

			// Categories
			$terms = wp_get_post_terms(get_the_ID(), 'category');
			if ($terms) {
				echo (count($terms) == 1) ? '<h5>Category</h5>' : '<h5>Categories</h5>';
				echo '<ul>';
				foreach ($terms as $term) {
					echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . $term->name . '</a></li>';
				}
				echo '</ul>';
			}

			// Tags
			$terms = wp_get_post_terms(get_the_ID(), 'post_tag');
			if ($terms) {
				echo (count($terms) == 1) ? '<h5>Tag</h5>' : '<h5>Tags</h5>';
				echo '<ul>';
				foreach ($terms as $term) {
					echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . $term->name . '</a></li>';
				}
				echo '</ul>';
			}
		?>

	</div>
</section>

<?php
	endwhile;
	endif;

	get_footer();
?>