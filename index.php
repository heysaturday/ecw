<?php
	get_header();
?>
<section class="layout-news">
	<?php if (isMainSite()): ?>
		<h2><a href="<?php echo esc_url(home_url('/news')); ?>">East Coast, Worldwide<br/><span>ECW+G News</span></a></h2>
	<?php else: ?>
		<h2><a href="<?php echo esc_url(home_url('/news')); ?>">News</a></h2>
	<?php endif; ?>
	<?php
		$category = single_cat_title('', FALSE);
		$searchQuery = get_search_query();
		$tag = single_tag_title('', FALSE);
		if ($searchQuery) {
			echo '<p class="search-query">You searched for “' . $searchQuery . '”</p>';
		} else if ($category) {
			echo '<p class="search-query">“' . $category . '”</p>';
		} else if ($tag) {
			echo '<p class="search-query">“' . $tag . '”</p>';
		} else if (is_day()) {
			echo '<p class="search-query">“' . get_the_date() . '</p>';
		} else if (is_month()) {
			echo '<p class="search-query">“' . get_the_date('F Y') . '</p>';
		} else if (is_year()) {
			echo '<p class="search-query">' . get_the_date('Y') . '</p>';
		}
	?>
	<div class="news-main">
		<?php
			if (have_posts()):
				while (have_posts()):
					the_post();
					get_template_part('includes/partials/card-post');
				endwhile;
			else:
				echo '<p class="no-results">No results found.</p>';
			endif;
		?>
		<p class="pagination"><?php echo paginate_links(); ?></p>
	</div>
	<div class="news-side">
		<?php get_search_form(); ?>
		<h5>Archives</h5>
		<ul><?php wp_get_archives(array(
			'show_post_count' => TRUE,
			'type' => 'yearly'
		)); ?></ul>
		<h5>Categories</h5>
		<ul><?php echo wp_list_categories(array(
			'show_count' => TRUE,
			'title_li' => FALSE
		)); ?></ul>
	</div>
</section>
<?php get_footer(); ?>