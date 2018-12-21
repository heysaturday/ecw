		<?php get_template_part('includes/partials/franchise-info'); ?>


		<footer>
			<h6><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h6>
			<ul class="primary">
				<?php wp_nav_menu(array(
                    'container'			=> false,
                    'depth'				=> 1,
                    'items_wrap'		=> '%3$s',
                    'menu'				=> 'footer',
                    'theme_location'	=> 'footer'
                )); ?>
			</ul>
			<ul class="secondary">
				<?php if (isMainSite()): ?>
					<?php $location = getNearestLocation(); ?>
					<?php if (get_field('order_online_url', 'option')): ?>
						<li><a style="min-width: 200px;" class="button-orange" href="<?php echo widont($location['olo_url']) ? $location['olo_url'] : the_field('order_online_url', 'option'); ?>" target="_blank">Order for Pickup <i class="icon icon-angle-double-right"></i></a></li>
					<?php endif; ?>

					<?php if (widont($location['door_dash_id'])): ?>
						<li><a style="min-width: 200px;" class="button-orange" href="https://www.doordash.com/store/<?php echo widont($location['door_dash_id']);?>/?utm_source=partner-link&utm_medium=website&utm_campaign=<?php echo widont($location['door_dash_id']);?>" target="_blank">Order for Delivery <i class="icon icon-angle-double-right"></i></a></li>
					<?php endif; ?>
					<?php if (get_field('newsletter_url', 'option')): ?><li><a href="<?php the_field('newsletter_url', 'option'); ?>" target="_blank">Newsletter Signup</a></li><?php endif; ?>
					<?php if (get_field('franchise_url', 'option')): ?><li><a href="<?php the_field('franchise_url', 'option'); ?>" target="_blank">Franchise Opportunities</a></li><?php endif; ?>
				<?php else: ?>
					<?php if (get_field('franchisee_login_url', 'option')): ?><li><a class="button-orange" href="<?php the_field('franchisee_login_url', 'option'); ?>" target="_blank">Franchisee Login <i class="icon icon-angle-double-right"></i></a></li><?php endif; ?>
					<?php if (get_field('main_site_url', 'option')): ?><li><a href="<?php the_field('main_site_url', 'option'); ?>" target="_blank">Main Site</a></li><?php endif; ?>
				<?php endif; ?>
			</ul>
			<ul class="social">
				<li><a href="<?php the_field('facebook_url', 'option'); ?>" target="_blank"><i class="icon icon-facebook"></i></a></li>
				<li><a href="<?php the_field('twitter_url', 'option'); ?>" target="_blank"><i class="icon icon-twitter"></i></a></li>
				<li><a href="<?php the_field('instagram_url', 'option'); ?>" target="_blank"><i class="icon icon-instagram"></i></a></li>
			</ul>
			<p>&copy; <?php echo date('Y'); ?> ECW+G. All rights reserved.
				<a href="<?php the_field('privacy_policy_url', 'option'); ?>" >Privacy Policy</a></p>
		</footer>
	</main></div>

	<?php wp_footer(); ?>

	<?php if (get_field('google_analytics_id', 'option')): ?>

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', '<?php the_field('google_analytics_id', 'option'); ?>', 'auto');
			ga('send', 'pageview');
		</script>

	<?php endif; ?>

	<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=<?php the_field('api_key', 'option'); ?>"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/libraries.js?<?php echo CACHE_BUSTER; ?>"></script>
	<script src="<?php bloginfo('template_directory'); ?>/assets/js/scripts.js?<?php echo CACHE_BUSTER; ?>"></script>

</body>
</html>
