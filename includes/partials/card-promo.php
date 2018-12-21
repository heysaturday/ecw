<?php
	$title = get_the_title();
	$title = truncate($title, 30);
	$image = get_field('image');
	$image = ($image['sizes'] && $image['sizes']['large']) ? $image['sizes']['large'] : '';
?>
<article class="card-promo" style="background-color:<?php the_field('background_color'); ?>;">
	<a href="<?php the_permalink(); ?>" style="color:<?php the_field('text_color'); ?>;">
		<div class="image" style="background-image:url('<?php echo $image; ?>');"></div>
		<div class="overlay"></div>
		<h3 style="border-color:<?php the_field('text_color'); ?>; color:<?php the_field('text_color'); ?>;"><?php echo $title; ?></h3>
	</a>
</article>
