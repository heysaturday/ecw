<?php
/**
 * Template Name: Contact
 */

	if (isMainSite()) {

		// get locations
		$location = getNearestLocation();
		$locations = getLocationsOrderedByNearest();
		$temp = array();
		$temp['No Location'] = 'No Location';
		if (!empty($locations)) {
			foreach ($locations as $l) {
				$temp[ $l['title'] ] = $l['title'];
			}
		}
		$locations = $temp;

		// setup form
		$form = new Form();
		$form->add_fieldset('');
		$form->add_field_textarea('Message', 'contact-message', 'required', FALSE, FALSE, array('placeholder'=>'Your Message'));
		$form->add_field_text('Name', 'contact-name', 'required', FALSE, FALSE, array('placeholder'=>'Your Name'));
		$form->add_field_text('Email', 'contact-email', 'required|valid_email', FALSE, FALSE, array('placeholder'=>'Your Email'));
		$form->add_field_select('Location', 'contact-location', $locations, 'required', FALSE);

		$is_valid = $form->validate();

		// send email
		if ($is_valid) {

			// set values
			$recipient = get_field('contact_form_recipient', 'option');
			$subject = get_field('contact_form_subject', 'option');
			$name = ucfirst(stripslashes(strip_tags(trim($_POST['contact-name']))));
			$email = stripslashes(strip_tags(trim($_POST['contact-email'])));
			$location = stripslashes(strip_tags(trim($_POST['contact-location'])));
			$message = stripslashes(strip_tags(trim($_POST['contact-message'])));
			$message .= "\n\n--\n" . $name . "\n" . $email . "\n" . $location;

			// sending email with PHP's mail function
			$result = php_email($recipient, $name, $email, $subject, $message);
			if ($result == FALSE) {
				$is_valid = FALSE;
				$form->set_alert('Uh-oh!', 'There was an error sending your email.', 'error');
			}

		}

	} else {

		// setup form
		$form = new Form();
		$form->add_fieldset('');
		$form->add_field_text('Name', 'contact-name', 'required', FALSE, FALSE, array('placeholder'=>'Your Name'));
		$form->add_field_text('Email', 'contact-email', 'required|valid_email', FALSE, FALSE, array('placeholder'=>'Your Email'));
		$form->add_field_text('Phone', 'contact-phone', 'required|valid_phone', FALSE, FALSE, array('placeholder'=>'Your Phone'));
		$form->add_field_textarea('Address', 'contact-address', 'required', FALSE, FALSE, array('placeholder'=>'Your Address'));
		$form->add_field_textarea('Referrer', 'contact-message', '', FALSE, FALSE, array('placeholder'=>'How did you hear about us?'));
		$form->add_field_select('Liquid Assets', 'contact-liquid-assets', array(
			'$250,000-$350,0000' => '$250,000-$350,0000',
			'$351,0000-$450,0000' => '$351,0000-$450,0000',
			'$451,0000-$550,0000' => '$451,0000-$550,0000',
			'$551,0000+ over' => '$551,0000+ over'
		), 'required', FALSE);
		$form->add_field_select('Net Worth', 'contact-net-worth', array(
			'$250,000-$550,0000' => '$250,000-$550,0000',
			'$550,0000-$750,0000' => '$550,0000-$750,0000',
			'$750,0000-$1 million' => '$750,0000-$1 million',
			'$1 million - $1.5 million' => '$1 million - $1.5 million',
			'over $1.5 million' => 'over $1.5 million'
		), 'required', FALSE);


		$is_valid = $form->validate();

		// send email
		if ($is_valid) {

			// set values
			$recipient = get_field('contact_form_recipient', 'option');
			$subject = get_field('contact_form_subject', 'option');
			$name = ucfirst(stripslashes(strip_tags(trim($_POST['contact-name']))));
			$email = stripslashes(strip_tags(trim($_POST['contact-email'])));
			$phone = stripslashes(strip_tags(trim($_POST['contact-phone'])));
			$address = stripslashes(strip_tags(trim($_POST['contact-address'])));
			$message = stripslashes(strip_tags(trim($_POST['contact-message'])));
			$message .= "\nLiquid Assets: " . stripslashes(strip_tags(trim($_POST['contact-liquid-assets'])));
			$message .= "\nNet Worth: " . stripslashes(strip_tags(trim($_POST['contact-net-worth'])));
			$message .= "\n\n--\n" . $name . "\n" . $email . "\n" . $phone . "\n" . $address;

			// sending email with PHP's mail function
			$result = php_email($recipient, $name, $email, $subject, $message);
			if ($result == FALSE) {
				$is_valid = FALSE;
				$form->set_alert('Uh-oh!', 'There was an error sending your email.', 'error');
			}

		}

	}

	get_header();

	if (have_posts()):
	while (have_posts()):
	the_post();
?>

<section class="layout-image-right">
	<?php
		$image = get_field('image');
		$image = ($image['sizes'] && $image['sizes']['large']) ? $image['sizes']['large'] : '';
		$position = get_field('image_position');
	?>
	<div class="image" style="background-image:url('<?php echo $image; ?>'); background-position:<?php echo $position; ?>; background-repeat:no-repeat; background-size:contain;"></div>
	<article>
		<?php
			if ($is_valid) {
				echo '<h2>Thank you!</h2>';
				echo '<p>Your message has been sent.</p>';
				if (get_field('newsletter_url', 'option')) {
					echo '<p><a class="button-orange" href="' . get_field('newsletter_url', 'option') . '" target="_blank">Newsletter Signup <i class="icon icon-angle-double-right"></i></a></p>';
				}
			} else {
				echo '<h2>' . get_the_title() . '</h2>';
				the_content();
				echo $form->generate();
			}
		?>
	</article>
</section>

<?php
	endwhile;
	endif;

	get_footer();
?>