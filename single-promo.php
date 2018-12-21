<?php
	get_header();

	if (have_posts()):
	while (have_posts()):
	the_post();
?>

<?php
	$image = get_field('image');
	$image = ($image['sizes'] && $image['sizes']['large']) ? $image['sizes']['large'] : '';
?>
<section class="layout-promo" style="background-color:<?php the_field('background_color'); ?>; background-image:url('<?php echo $image; ?>');">
	<article>
		<h2 style="border-color:<?php the_field('text_color'); ?>; color:<?php the_field('text_color'); ?>;"><?php the_title(); ?></h2>
		<div>
			<?php the_content(); ?>
			<ul class="sharing">
				<li class="twitter">
					<a href="https://twitter.com/share" class="twitter-share-button"{count} data-url="<?php the_permalink(); ?>">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</li>
				<li class="facebook">
					<div id="fb-root"></div>
					<script>
						(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=201385210204642";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));
					</script>
					<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button"></div>
				</li>
			</ul>
		</div>
	</article>
</section>

<?php
	endwhile;
	endif;

	get_footer();
?>