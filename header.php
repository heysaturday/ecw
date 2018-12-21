<!doctype html>
<html class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php wp_title('-', true, 'right'); ?></title>
	<meta name="title" content="<?php wp_title('-', true, 'right'); ?>" />
	<meta name="copyright" content="Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved." />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

	<?php wp_head(); ?>

	<link rel="stylesheet" media="print" href="<?php bloginfo('template_directory'); ?>/assets/css/print.css?<?php echo CACHE_BUSTER; ?>" />
	<link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/assets/css/screen.css?<?php echo CACHE_BUSTER; ?>" />
	<!--[if IE]>
		<link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/assets/css/screen-ie.css?<?php echo CACHE_BUSTER; ?>" />
	<![endif]-->
	<!--[if lte IE 8]>
		<style>
			body {
				background-image: url('<?php bloginfo('template_directory'); ?>/assets/img/logo@2x.png');
				background-position: center center;
				background-repeat: no-repeat;
			}
			#main {
				display: none !important;
			}
		</style>
		<script>window.isBadBrowser = true;</script>
	<![endif]-->


</head>
<body data-theme-url="<?php bloginfo('template_directory'); ?>" data-url="<?php echo (is_archive()) ? get_post_type_archive_link('location') : get_permalink(); ?>"<?php if (isMainSite() == false || $_SESSION['show_alert'] == false): ?> class="hide-alert"<?php endif; ?>>
	<div id="main"><main>

		<header>
			<h1><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<button class="bars"><i class="icon icon-bars"></i></button>
			<nav>
				<div>
					<div>
						<ul class="primary">
							<?php wp_nav_menu(array(
                                'container'			=> false,
                                'depth'				=> 1,
                                'items_wrap'		=>'%3$s',
                                'menu'				=> 'header',
                                'theme_location'	=> 'header'
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
					</div>
					<ul class="social">
						<li><a href="<?php the_field('facebook_url', 'option'); ?>" target="_blank"><i class="icon icon-facebook"></i></a></li>
						<li><a href="<?php the_field('twitter_url', 'option'); ?>" target="_blank"><i class="icon icon-twitter"></i></a></li>
						<li><a href="<?php the_field('instagram_url', 'option'); ?>" target="_blank"><i class="icon icon-instagram"></i></a></li>
					</ul>
					<p>&copy; <?php echo date('Y'); ?> ECW+G. All rights reserved.</p>
				</div>
			</nav>
			<button class="flame"></button>
			<button class="arrow"><i class="icon icon-angle-right"></i></button>
			<div class="overlay"></div>
		</header>

		<?php if (isMainSite()): ?>
			<?php $location = getNearestLocation(); ?>
			<div id="header-alert">
				<p><a href="<?php echo $location['permalink']; ?>"><?php echo widont($location['title']); ?></a> is set as your current location.<?php if (is_archive('location') == false): ?>&nbsp;<a href="<?php echo esc_url(home_url('/location')); ?>">Change&nbsp;Location</a><?php endif; ?>&nbsp;<button><i class="icon icon-times"></i></button></p>
			</div>
		<?php endif; ?>
