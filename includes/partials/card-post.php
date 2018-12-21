<article class="card-post">
	<div class="image"><a href="<?php the_permalink(); ?>"><?php
		$image = get_field('image');
		$image = ($image['sizes'] && $image['sizes']['thumbnail']) ? $image['sizes']['thumbnail'] : get_template_directory_uri().'/assets/img/flame.jpg';
		if ($image) {
			echo '<img src="' . $image . '" />';
		}
	?><span><?php echo get_post_time('m/d/Y', TRUE); ?></span></a></div>
	<div class="info">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php echo truncate(trim(strip_tags(get_the_excerpt())), 280); ?>
		<p><a class="button-orange" href="<?php the_permalink(); ?>"><?php echo (get_field('button_text')) ? get_field('button_text') : 'Read More'; ?> <i class="icon icon-angle-right"></i></a></p>
	</div>
</article>