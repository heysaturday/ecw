<?php

	//////////////////////////////////////////////////
	// INCLUDES
	//////////////////////////////////////////////////

		require_once(dirname(__FILE__) . '/includes/classes/Form.php');
		require_once(dirname(__FILE__) . '/includes/classes/HtmlHelper.php');
		require_once(dirname(__FILE__) . '/includes/classes/MaxMind.php');
		require_once(dirname(__FILE__) . '/includes/classes/SinglePlatform.php');
		require_once(dirname(__FILE__) . '/includes/classes/Validation.php');


	//////////////////////////////////////////////////
	// CONSTANTS
	//////////////////////////////////////////////////

		// Misc
		define('CACHE_BUSTER',						'20171019');

		// MaxMind
		define('MAX_MIND_USER_ID',					'107036');
		define('MAX_MIND_LICENSE_KEY',				'YVkpk55UjJU1');

		// SinglePlatform
		define('SINGLE_PLATFORM_CLIENT_ID',			'c3sbrpbtkbs5gverurfkxpemc');
		define('SINGLE_PLATFORM_CLIENT_SECRET',		'PkkJXNRpO2l0r5u6u0PlCNme1KA8akGejMIjHI5Gkj8');


	//////////////////////////////////////////////////
	// MENUS & POST TYPES
	//////////////////////////////////////////////////

		// Register Menus
		function themeSetup() {
			register_nav_menu('header', 'Header Menu');
			register_nav_menu('footer', 'Footer Menu');
		}
		add_action('after_setup_theme', 'themeSetup');

		// Register Post Types
		function themeRegisterPostTypes() {

			if (isMainSite()) {

				// Flavors (post type)
					register_post_type(
						'flavor',
						array(
							'labels' => array(
								'name'					=> __('Flavors', 'eastcoastwings'),
								'singular_name'			=> __('Flavor',  'eastcoastwings'),
								'add_new'				=> 'Add New',
								'add_new_item'			=> 'Add New Flavor',
								'all_items'				=> 'All Flavors',
								'edit_item'				=> 'Edit Flavor',
								'menu_name'				=> 'Flavors',
								'not_found'				=> 'Flavors Not found',
								'not_found_in_trash'	=> 'Flavors Not found in Trash',
								'parent_item_colon'		=> 'Parent Flavor:',
								'search_items'			=> 'Search Flavors',
								'update_item'			=> 'Update Flavor',
								'view_item'				=> 'View Flavor'
							),
							'rewrite' => array(
								'feeds'				=> FALSE,
								'pages'				=> FALSE,
								'slug'				=> 'flavor',
								'with_front'		=> FALSE
							),
							'supports' => array(
								'title'
							),
							'can_export'			=> TRUE,
							'capability_type'		=> 'post',
							'exclude_from_search'	=> TRUE,
							'has_archive'			=> TRUE,
							'hierarchical'			=> FALSE,
							'menu_icon'				=> 'dashicons-awards',
							'menu_position'			=> 5,
							'public'				=> TRUE,
							'publicly_queryable'	=> TRUE,
							'show_in_admin_bar'		=> TRUE,
							'show_in_menu'			=> TRUE,
							'show_in_nav_menus'		=> TRUE,
							'show_ui'				=> TRUE
						)
					);


				// Flavor Categories (taxonomy)
					register_taxonomy(
						'flavor-category',
						array(
							'flavor'
						),
						array(
							'labels' => array(
								'name'				=> __('Categories', 'eastcoastwings'),
								'singular_name'		=> __('Category',  'eastcoastwings'),
								'all_items'			=> 'All Categories',
								'add_new_item'		=> 'Add New Category',
								'edit_item'			=> 'Edit Category',
								'menu_name'			=> 'Categories',
								'new_item_name'		=> 'New Category Name',
								'not_found'			=> 'Not Found',
								'parent_item'		=> 'Parent Category',
								'parent_item_colon'	=> 'Parent Category:',
								'popular_items'		=> 'Popular Categories',
								'search_items'		=> 'Search Categories',
								'update_item'		=> 'Update Category',
								'view_item'			=> 'View Category',
								'separate_items_with_commas'	=> 'Separate categories with commas',
								'add_or_remove_items'			=> 'Add or remove categories',
								'choose_from_most_used'			=> 'Choose from the most used categories'
							),
							'rewrite' => array(
								'feeds'				=> FALSE,
								'pages'				=> FALSE,
								'slug'				=> 'flavor-category',
								'with_front'		=> FALSE
							),
							'has_archive'			=> FALSE,
							'hierarchical'			=> FALSE,
							'public'				=> TRUE,
							'show_admin_column'		=> TRUE,
							'show_in_nav_menus'		=> TRUE,
							'show_tagcloud'			=> FALSE,
							'show_ui'				=> TRUE
						)
					);

				// Locations (post type)
					register_post_type(
						'location',
						array(
							'labels' => array(
								'name'					=> __('Locations', 'eastcoastwings'),
								'singular_name'			=> __('Location',  'eastcoastwings'),
								'add_new'				=> 'Add New',
								'add_new_item'			=> 'Add New Location',
								'all_items'				=> 'All Locations',
								'edit_item'				=> 'Edit Location',
								'menu_name'				=> 'Locations',
								'not_found'				=> 'Locations Not found',
								'not_found_in_trash'	=> 'Locations Not found in Trash',
								'parent_item_colon'		=> 'Parent Location:',
								'search_items'			=> 'Search Locations',
								'update_item'			=> 'Update Location',
								'view_item'				=> 'View Location'
							),
							'rewrite' => array(
								'feeds'				=> TRUE,
								'pages'				=> TRUE,
								'slug'				=> 'location',
								'with_front'		=> FALSE
							),
							'supports' => array(
								'title'
							),
							'can_export'			=> TRUE,
							'capability_type'		=> 'post',
							'exclude_from_search'	=> TRUE,
							'has_archive'			=> TRUE,
							'hierarchical'			=> FALSE,
							'menu_icon'				=> 'dashicons-location',
							'menu_position'			=> 5,
							'public'				=> TRUE,
							'publicly_queryable'	=> TRUE,
							'show_in_admin_bar'		=> TRUE,
							'show_in_menu'			=> TRUE,
							'show_in_nav_menus'		=> TRUE,
							'show_ui'				=> TRUE
						)
					);

				// Promos (post type)
					register_post_type(
						'promo',
						array(
							'labels' => array(
								'name'					=> __('Promos', 'eastcoastwings'),
								'singular_name'			=> __('Promo',  'eastcoastwings'),
								'add_new'				=> 'Add New',
								'add_new_item'			=> 'Add New Promo',
								'all_items'				=> 'All Promos',
								'edit_item'				=> 'Edit Promo',
								'menu_name'				=> 'Promos',
								'not_found'				=> 'Promos Not found',
								'not_found_in_trash'	=> 'Promos Not found in Trash',
								'parent_item_colon'		=> 'Parent Promo:',
								'search_items'			=> 'Search Promos',
								'update_item'			=> 'Update Promo',
								'view_item'				=> 'View Promo'
							),
							'rewrite' => array(
								'feeds'				=> TRUE,
								'pages'				=> TRUE,
								'slug'				=> 'promo',
								'with_front'		=> FALSE
							),
							'supports' => array(
								'editor',
								'title'
							),
							'can_export'			=> TRUE,
							'capability_type'		=> 'post',
							'exclude_from_search'	=> FALSE,
							'has_archive'			=> TRUE,
							'hierarchical'			=> FALSE,
							'menu_icon'				=> 'dashicons-megaphone',
							'menu_position'			=> 5,
							'public'				=> TRUE,
							'publicly_queryable'	=> TRUE,
							'show_in_admin_bar'		=> TRUE,
							'show_in_menu'			=> TRUE,
							'show_in_nav_menus'		=> TRUE,
							'show_ui'				=> TRUE
						)
					);

			}

		}
		add_action('init', 'themeRegisterPostTypes');

		// Fix menu classes
		function removeParentClasses($class) {
			return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item') ? FALSE : TRUE;
		}
		function themeAddClassToNavMenu($classes) {
			if (is_404()) {
				$classes = array_filter($classes, "removeParentClasses");
			}
			switch (get_post_type()) {

				case 'location':
					$classes = array_filter($classes, "removeParentClasses");
					if (in_array('menu-item-5805', $classes)) {
						$classes[] = 'current_page_parent';
					}
					break;

				case 'promo':
					$classes = array_filter($classes, "removeParentClasses");
					break;

			}
			return $classes;
		}
		add_filter('nav_menu_css_class', 'themeAddClassToNavMenu');


	//////////////////////////////////////////////////
	// ONLY SEARCH FOR POSTS
	//////////////////////////////////////////////////

		function themeSearchFilter($query) {
			if (!is_admin()) {
				if ($query->is_search) {
					$query->set('post_type', 'post');
				}
			}
			return $query;
		}
		add_filter('pre_get_posts', 'themeSearchFilter');


	//////////////////////////////////////////////////
	// HIDE ELEMENTS WITHIN WORDPRESS ADMIN
	//////////////////////////////////////////////////
	

		//Backup Buddy Remove
		add_action('admin_head', 'custom_admin_css');

		function custom_admin_css() {
  			echo '<style>
    		li#toplevel_page_pb_backupbuddy_backup {
    		display: none;
			}
  			</style>';
		}

		// Removes from admin menu
		function themeRemoveAdminMenus() {
			//remove_menu_page('edit.php'); // Posts
			//remove_menu_page('upload.php'); // Media
			remove_menu_page('link-manager.php'); // Links
			remove_menu_page('edit-comments.php'); // Comments
			//remove_menu_page('edit.php?post_type=page'); // Pages
			remove_menu_page('plugins.php'); // Plugins
			remove_menu_page('themes.php'); // Appearance
			//remove_menu_page('users.php'); // Users
			remove_menu_page('tools.php'); // Tools
			remove_menu_page('options-general.php'); // Settings
			remove_menu_page('edit.php?post_type=acf'); // Custom Fields
			remove_menu_page('edit.php?post_type=acf-field-group'); // Custom Fields Pro
			remove_menu_page('admin.php?page=pb_backupbuddy'); // BackupBuddy
		}
		add_action('admin_menu', 'themeRemoveAdminMenus', 9999);

		

		// Removes from post and pages
		function themeRemoveCommentSupport() {
			remove_post_type_support('post', 'comments');
			remove_post_type_support('page', 'comments');
		}
		add_action('init', 'themeRemoveCommentSupport', 100);

		// Removes from admin bar
		function themeRemoveComments() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('comments');
			//$wp_admin_bar->remove_menu('new-post');
			//$wp_admin_bar->remove_menu('new-posts');
			//$wp_admin_bar->remove_menu('new-page');
			$wp_admin_bar->remove_menu('new-media');
			//$wp_admin_bar->remove_menu('new-user');
		}
		add_action('wp_before_admin_bar_render', 'themeRemoveComments');

		// Add options page
		if (function_exists('acf_add_options_page')) {
			acf_add_options_page();
			acf_add_options_sub_page(Options);

		}


	//////////////////////////////////////////////////
	// PSEUDO CRONS
	//////////////////////////////////////////////////

		function updateSinglePlatformCache() {

			global $wpdb;
			$singlePlatform = new SinglePlatform(SINGLE_PLATFORM_CLIENT_ID, SINGLE_PLATFORM_CLIENT_SECRET);

			// create database table
			$wpdb->query("
				CREATE TABLE `singleplatform` (
					`ID` bigint(20) unsigned NOT NULL,
					`content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
					`imported` datetime DEFAULT '0000-00-00 00:00:00',
					KEY `ID` (`ID`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;
			");

			// get all locations
			$query = new WP_Query(array(
				'posts_per_page' => -1,
				'post_type' => 'location'
			));
			$locations = array();
			while ($query->have_posts()) {
				$query->the_post();
				$locations[] = array(
					'id' => get_the_ID(),
					'content' => json_encode( $singlePlatform->getLocationData( get_field('location_id') ) )
				);
			}
			wp_reset_postdata();

			// update database
			if (!empty($locations)) {
				//$wpdb->query("TRUNCATE TABLE `singleplatform`");

				$items = [];
				$results = $wpdb->get_results("SELECT `ID` FROM `singleplatform` WHERE 1", OBJECT);
				if (!empty($results)) {
					foreach ($results as $result) {
						$items[$result->ID] = TRUE;
					}
				}

				foreach ($locations as $location) {

					if ($items[$location['id']]) {
						$wpdb->query($wpdb->prepare("UPDATE `singleplatform`
							SET
								`content` = %s,
								`imported` = %s
							WHERE `ID` = %s
						",
							$location['content'],
							date('Y-m-d H:i:s'),
							$location['id']
						));
					} else {
						$wpdb->query($wpdb->prepare("INSERT IGNORE INTO `singleplatform` (
							`ID`,
							`content`,
							`imported`
						) VALUES (
							%s,
							%s,
							%s
						)",
							$location['id'],
							$location['content'],
							date('Y-m-d H:i:s')
						));
					}

				}
			}

		}
		function updateSinglePlatformCacheActivation() {
			if (isMainSite()) {
				if ($_GET && $_GET['update'] && $_GET['update'] == 'singleplatform') {
					updateSinglePlatformCache();
					echo 'Update SinglePlatform!';
					die;
				}
				if (!wp_next_scheduled('updateSinglePlatformCacheHook')) {
					wp_schedule_event(time(), 'twicedaily', 'updateSinglePlatformCacheHook');
				}
			}
		}
		add_action('updateSinglePlatformCacheHook', 'updateSinglePlatformCache');
		add_action('wp', 'updateSinglePlatformCacheActivation');


	//////////////////////////////////////////////////
	// GEO LOCATION
	//////////////////////////////////////////////////

		function setGeoLocation() {
			if ( 'index.php' == $GLOBALS['pagenow'] ) {
				if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
					// kill if AJAX request
					return;
				}
				if (is_admin()) {
					// kill if in admin
					return;
				}
				if (in_array($GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php'))) {
					// kill if on login or register pages
					return;
				}
				if (!isBrowser()) {
					// kill if isn't white listed browser
					return;
				}
				if (isMainSite()) {
					if (!isset($_SESSION)) {
						session_start();
					}
					if (isset($_GET) && isset($_GET['hide_alert']) && !empty($_GET['hide_alert'])) {
						$_SESSION['show_alert'] = FALSE;
					}
					if (empty($_SESSION['latitude']) || empty($_SESSION['longitude'])) {
						$maxMind = new MaxMind(MAX_MIND_USER_ID, MAX_MIND_LICENSE_KEY);
						$ipAddress = getIpAddress();
						$_SESSION['show_alert'] = TRUE;
						if ($ipAddress) {
							$data = $maxMind->getGeoLocation($ipAddress);
							$_SESSION['latitude'] = $data['latitude'];
							$_SESSION['longitude'] = $data['longitude'];
						} else {
							$_SESSION['latitude'] = $maxMind->defaultLatitude;
							$_SESSION['longitude'] = $maxMind->defaultLongitude;
						}
					}
					if (isset($_GET) && isset($_GET['latitude']) && isset($_GET['longitude']) && !empty($_GET['latitude']) && !empty($_GET['longitude'])) {
						$_SESSION['show_alert'] = TRUE;
						$_SESSION['latitude'] = $_GET['latitude'];
						$_SESSION['longitude'] = $_GET['longitude'];
					}
				}
			}
		}
		function getIpAddress() {
			if (function_exists('apache_request_headers')) {
				$headers = apache_request_headers();
			} else {
				$headers = $_SERVER;
			}
			if (array_key_exists('X-Forwarded-For', $headers) && filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
				$ipAddress = $headers['X-Forwarded-For'];
			} else if (array_key_exists('HTTP_X_FORWARDED_FOR', $headers) && filter_var($headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
				$ipAddress = $headers['HTTP_X_FORWARDED_FOR'];
			} else {
				$ipAddress = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
			}
			if (empty($ipAddress) || $ipAddress === '127.0.0.1') {
				$ipAddress = FALSE;
			}
			return $ipAddress;
		}
		//add_action('init', 'setGeoLocation');
		add_action('wp_loaded', 'setGeoLocation');


	//////////////////////////////////////////////////
	// HELPERS
	//////////////////////////////////////////////////

		// Is main site?
		function isMainSite() {
			$url = get_bloginfo('template_directory');
			if (strpos($url, 'franchise') === FALSE) {
				return TRUE;
			}
			return FALSE;
		}

		// Is Browser?
		function isBrowser() {
			$userAgent = $_SERVER['HTTP_USER_AGENT'];
			if (strpos(strtolower($userAgent), "chrome/")) { // Chrome
				return TRUE;
			} else if (strpos(strtolower($userAgent), "msie")) { // Internet Explorer
				return TRUE;
			} else if (strpos(strtolower($userAgent), "firefox/")) { // Firefox
				return TRUE;
			} else if (strpos(strtolower($userAgent), "safari/")) { // Safari
				return TRUE;
			}
			return FALSE;
		}

		// Distance
		function calculateDistance($lat1, $lon1, $lat2, $lon2) {
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			return $miles;
		}
		function sortLocationsByDistance($item1, $item2) {
			if ($item1['distance'] == $item2['distance']) {
				return 0;
			}
			return ($item1['distance'] > $item2['distance']) ? 1 : -1;
		}

		// Email
		function php_email($recipient, $name, $email, $subject, $message) {
			$headers = "Date: " . date("r") . "\r\n";
			$headers .= "From: " . $name . " <" . $email . ">\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/plain; charset=ISO-8859-1";
			return mail($recipient, $subject, $message, $headers);
		}

		// Location
		function getLocationData() {
			return array(
				'distance' => calculateDistance(get_field('latitude'), get_field('longitude'), $_SESSION['latitude'], $_SESSION['longitude']),
				'id' => get_the_ID(),
				'name' => (get_field('name')) ? get_field('name') : get_field('city'),
				'title' => get_the_title(),
				'phone_number' => get_field('phone_number'),
				'permalink' => get_the_permalink(),
				'address_1' => get_field('address_1'),
				'address_2' => get_field('address_2'),
				'city' => get_field('city'),
				'state' => get_field('state'),
				'postal_code' => get_field('postal_code'),
				'latitude' => get_field('latitude'),
				'longitude' => get_field('longitude'),
				'door_dash_id' => get_field('door_dash_id'),
				'olo_url' => get_field('olo_url')
			);
		}
		function getLocationsOrderedByNearest() {
			$query = new WP_Query(array(
				'posts_per_page' => -1,
				'post_type' => 'location'
			));
			$locations = array();
			while ($query->have_posts()) {
				$query->the_post();
				$locations[] = getLocationData();
			}
			wp_reset_query();
			usort($locations, 'sortLocationsByDistance');
			return $locations;
		}
		function getNearestLocation() {
			$locations = getLocationsOrderedByNearest();
			return $locations[0];
		}
		function getLocation($id) {
			$query = new WP_Query(array(
				'p' => $id,
				'posts_per_page' => 1,
				'post_type' => 'location'
			));
			$location = FALSE;
			while ($query->have_posts()) {
				$query->the_post();
				$location = getLocationData();
			}
			wp_reset_query();
			if (!empty($location)) {
				return $location;
			}
			return getNearestLocation();
		}

		// Menu
		function getMenuForLocation($id) {
			global $wpdb;
			$data = $wpdb->get_row("SELECT `content` FROM `singleplatform` WHERE ID = '" . $id . "' LIMIT 1", OBJECT);
			if (!empty($data)) {
				return json_decode($data->content, TRUE);
			}
			return FALSE;
		}

		// Truncate
		function truncate($string, $limit, $break=' ', $pad='...') {
			if (strlen($string) <= $limit) {
				return $string;
			}
			$string = substr($string, 0, $limit);
			$breakpoint = strrpos($string, $break);
			if ($breakpoint !== FALSE) {
				$string = substr($string, 0, $breakpoint);
			}
			return $string . $pad;
		}

		// Widon't
		function widont($str='') {
			return preg_replace( '|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', $str);
		}

		// Slugify
		function slugify($text) {
			$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
			$text = trim($text, '-');
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
			$text = strtolower($text);
			$text = preg_replace('~[^-\w]+~', '', $text);
			if (empty($text)) {
				return 'n-a';
			}
			return $text;
		}
