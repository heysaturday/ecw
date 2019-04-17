<?php

	// HtmlHelper & Validation classes are required

	class Form {

		private $_callback_object;
		private $_errors = array();
		private $_error_messages = array(
			'required'				=> 'The %s field is required.',
			'isset'					=> 'The %s field must have a value.',
			'valid_email'			=> 'The %s field must contain a valid email address.',
			'valid_phone'			=> 'The %s field must contain a valid phone number.',
			'valid_url'				=> 'The %s field must contain a valid URL.',
			'min_length'			=> 'The %s field must be at least %s characters in length.',
			'max_length'			=> 'The %s field can not exceed %s characters in length.',
			'exact_length'			=> 'The %s field must be exactly %s characters in length.',
			'alpha'					=> 'The %s field may only contain alphabetical characters.',
			'alpha_numeric'			=> 'The %s field may only contain alpha-numeric characters.',
			'alpha_dash'			=> 'The %s field may only contain alpha-numeric characters, underscores, and dashes.',
			'numeric'				=> 'The %s field must contain only numeric characters.',
			'integer'				=> 'The %s field must contain an integer.',
			'matches'				=> 'The %s field does not match the %s field.',
			'natural'				=> 'The %s field must contain only positive numbers.',
			'decimal'				=> 'The %s field must contain a decimal number.',
			'less_than'				=> 'The %s field must contain a number less than %s.',
			'greater_than'			=> 'The %s field must contain a number greater than %s.'
		);

		private $_fields = array();
		private $_record = array();

		private $_alert = FALSE;
		private $_action = FALSE;
		private $_multipart = FALSE;
		private $_template = NULL;

		// Constructor
			public function __construct() {
				$this->_callback_object = $this;
			}


		// ------------------------------------------------------------------------


		// Setters
			public function set_error($field, $error) {
				$this->_errors[$field] = $error;
			}
			public function set_error_message($rule, $message) {
				$this->_error_messages[$rule] = $message;
			}
			public function set_callback_object($object) {
				$this->_callback_object = $object;
			}
			public function set_alert($title, $message, $type=FALSE) {
				$this->_alert = array(
					'title'		=> $title,
					'message'	=> $message,
					'type'		=> $type
				);
			}
			public function set_record($value) {
				$this->_record = $value;
			}
			public function set_action($value) {
				$this->_action = $value;
			}
			public function set_multipart($value) {
				$this->_multipart = $value;
			}
			public function set_template($template) {
				if (!is_array($template)) {
					return FALSE;
				}
				$this->_template = $template;
			}


		// ------------------------------------------------------------------------


		// Getters
			public function get_error($field) {
				if (empty($this->_errors[$field])) {
					return '';
				}
				return $this->_errors[$field];
			}


		// ------------------------------------------------------------------------


		// Add Fields
			public function add_fieldset($label) {
				$array = array();
				$array['type'] = 'fieldset';
				$array['label'] = $label;
				$this->_add_field($array);
			}
			public function add_field_checkbox($label, $name, $rules='', $note='', $value='') {
				$this->_add_field(array(
					'type'			=> 'checkbox',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> FALSE,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> array()
				));
			}
			public function add_field_checkboxes($label, $name, $options, $rules='', $note='', $value='') {
				$this->_add_field(array(
					'type'			=> 'checkboxes',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> $options,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> array()
				));
			}
			public function add_field_date($label, $name, $rules='', $note='', $value='') {
				$this->_add_field(array(
					'type'			=> 'date',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> FALSE,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> array()
				));
			}
			public function add_field_datetime($label, $name, $rules='', $note='', $value='') {
				$this->_add_field(array(
					'type'			=> 'datetime',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> FALSE,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> array()
				));
			}
			public function add_field_file($label, $name, $rules='', $note='', $file='', $attributes=array()) {
				$this->_add_field(array(
					'type'			=> 'file',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> FALSE,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> $attributes
				));
			}
			public function add_field_hidden($name, $value, $attributes=array()) {
				$this->_add_field(array(
					'type'			=> 'hidden',
					'label'			=> '',
					'name'			=> $name,
					'options'		=> FALSE,
					'rules'			=> '',
					'note'			=> '',
					'value'			=> $value,
					'attributes'	=> $attributes
				));
			}
			public function add_field_password($label, $name, $rules='', $note='', $value='', $attributes=array()) {
				$this->_add_field(array(
					'type'			=> 'password',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> FALSE,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> $attributes
				));
			}
			public function add_field_radios($label, $name, $options, $rules='', $note='', $value='') {
				$this->_add_field(array(
					'type'			=> 'radios',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> $options,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> array()
				));
			}
			public function add_field_select($label, $name, $options, $rules='', $note='', $value='', $attributes=array()) {
				$this->_add_field(array(
					'type'			=> 'select',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> $options,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> $attributes
				));
			}
			public function add_field_text($label, $name, $rules='', $note='', $value='', $attributes=array()) {
				$this->_add_field(array(
					'type'			=> 'text',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> FALSE,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> $attributes
				));
			}
			public function add_field_textarea($label, $name, $rules='', $note='', $value='', $attributes=array()) {
				$this->_add_field(array(
					'type'			=> 'textarea',
					'label'			=> $label,
					'name'			=> $name,
					'options'		=> FALSE,
					'rules'			=> $rules,
					'note'			=> $note,
					'value'			=> $value,
					'attributes'	=> $attributes
				));
			}
			private function _add_field($value) {
				if (!empty($value['name']) && empty($value['value']) && !empty($this->_record[$value['name']])) {
					$value['value'] = $this->_record[$value['name']];
				}
				$this->_fields[$value['name']] =  $value;
			}


		// ------------------------------------------------------------------------


		// Validation
			public function validate() {
				$return = $this->_validate();
				if ($return) {
					$this->_compile_template();
					$this->set_alert(
						$this->_template['success_title'],
						$this->_template['success_message'],
						'success'
					);
				}
				return $return;
			}
			private function _validate() {

				// Do we even have any data to process? Mm?
				if (count($_POST) == 0) {
					return FALSE;
				}

				// Execute validation rules.
				if (!empty($this->_fields)) {
					foreach ($this->_fields as $field) {
						$postdata = ($_POST[$field['name']]) ? $_POST[$field['name']] : '';
						if (!empty($field['rules'])) {
							$this->_execute($field, explode('|', $field['rules']), $postdata);
						}
					}
				}

				// No errors, validation passed!
				if (count($this->_errors) == 0) {
					return TRUE;
				}

				// Validation failed.
				return FALSE;
			}
			private function _execute($field, $rules, $postdata='') {
				foreach ($rules as $rule) {

					$param = FALSE;
					if (preg_match('/(.*?)\[(.*)\]/', $rule, $match)) {
						$rule	= $match[1];
						$param	= $match[2];
					}

					if (($field['type'] == 'date' OR $field['type'] == 'datetime') AND $rule == 'required') {
						continue;
					}

					if (($field['type'] == 'checkboxes' OR $field['type'] == 'radios') AND $rule == 'required') {
						if (empty($postdata)) {
							$message = ($this->_error_messages[$rule]) ? $this->_error_messages[$rule] : '?????';
							$this->_errors[$field['name']] = sprintf($message, $field['label'], $param);
							return;
						}
						continue;
					}

					if (method_exists('Validation', $rule)) {
						if ($rule == 'matches') {
							$value = ($_POST[$param]) ? $_POST[$param] : '';
							$result = Validation::$rule($postdata, $value);
							if ($result === FALSE) {
								$message = ($this->_error_messages[$rule]) ? $this->_error_messages[$rule] : '?????';
								$this->_errors[$field['name']] = sprintf($message, $field['label'], $this->_fields[$param]['label']);
								return;
							}
							continue;
						} else {
							$param = (float)$param;
						}

						$result = Validation::$rule($postdata, $param);
						if ($result === FALSE) {
							$message = ($this->_error_messages[$rule]) ? $this->_error_messages[$rule] : '?????';
							$this->_errors[$field['name']] = sprintf($message, $field['label'], $param);
							return;
						}
						continue;
					}

					if (substr($rule, 0, 9) == 'callback_') {
						$rule = substr($rule, 9);
						if (method_exists($this->_callback_object, $rule)) {
							$result = $this->_callback_object->$rule($postdata, $param, $field['name'], $field['label']);
							if ($result === FALSE) {
								$message = ($this->_error_messages[$rule]) ? $this->_error_messages[$rule] : '?????';
								$this->_errors[$field['name']] = sprintf($message, $field['label'], $this->_fields[$param]['label']);
								return;
							}
							continue;
						}
					}

					// if callback method doesn't exist on callback_object, check to see if its a global function
					if (function_exists($rule)) {
						$result = $rule($postdata, $param, $field['name'], $field['label']);
						if ($result === FALSE) {
							$message = ($this->_error_messages[$rule]) ? $this->_error_messages[$rule] : '?????';
							$this->_errors[$field['name']] = sprintf($message, $field['label'], $param);
							return;
						}
						continue;
					}

				}
			}


		// ------------------------------------------------------------------------


		// Build HTML
			public function generate() {

				// Begin
					$this->_compile_template();
					$has_fieldset = FALSE;
					$html = $this->_template['form_prefix'];
					$html .= ($this->_multipart) ? HtmlHelper::form_open_multipart($this->_action, array('class' => $this->_template['form_class'], 'novalidate' => 'novalidate')) : HtmlHelper::form_open($this->_action, array('class' => $this->_template['form_class'], 'novalidate' => 'novalidate'));

				// Alert
					if (count($this->_errors) > 0) {
						$this->set_alert(
							$this->_template['error_title'],
							(count($this->_errors) > 1) ? sprintf($this->_template['error_message_plural'], count($this->_errors)) : sprintf($this->_template['error_message_singular'], count($this->_errors)),
							'error'
						);
					}
					if ($this->_alert !== FALSE) {
						$html .= HtmlHelper::alert(
							$this->_alert['title'],
							$this->_alert['message'],
							$this->_alert['type'],
							FALSE
						);
					}
				// Fields
					if (!empty($this->_fields)) {
						foreach ($this->_fields as $field) {
							if ($field['type'] == 'fieldset') {
								if ($has_fieldset) {
									$html .= HtmlHelper::fieldset_close();
								}
								$html .= HtmlHelper::fieldset_open($field['label']);
								$has_fieldset = TRUE;
							} else {
								if ($field['type'] == 'hidden') {
									$value = (!empty($field['value'])) ? $field['value'] : '';
									$html .= HtmlHelper::input_hidden($field['name'], $value);
								} else {
									switch ($field['type']) {
										case 'checkbox':
											$html .= $this->_generate_checkbox($field);
											break;
										case 'checkboxes':
											$html .= $this->_generate_checkboxes($field);
											break;
										case 'date':
											$html .= $this->_generate_date($field);
											break;
										case 'datetime':
											$html .= $this->_generate_datetime($field);
											break;
										case 'file':
											$html .= $this->_generate_file($field);
											break;
										case 'radios':
											$html .= $this->_generate_radios($field);
											break;
										case 'select':
											$html .= $this->_generate_select($field);
											break;
										case 'text':
										case 'password':
											$html .= $this->_generate_text($field);
											break;
										case 'textarea':
											$html .= $this->_generate_textarea($field);
											break;
									}
								}
							}
						}
					}
				// Submit Button
					$html .= $this->_template['submit_button_prefix'];
					$html .= HtmlHelper::button($this->_template['submit_button_label']);
					$html .= $this->_template['submit_button_suffix'];
				// End
					if ($has_fieldset) {
						$html .= HtmlHelper::fieldset_close();
					}
					$html .= HtmlHelper::form_close();
					$html .= $this->_template['form_suffix'];
				// Return
					return $html;
			}


		// ------------------------------------------------------------------------


		// Generate Fields
			private function _generate_group($field, $input) {
				// Error
					$error = $this->get_error($field['name']);
				// Classes
					$class = '';
					$class .= (strpos($field['rules'], 'required') !== FALSE) ? ' required' : '';
					$class .= ($error) ? ' error' : '';
				// Build HTML
					$html = $this->_template['field_group_prefix'];
					$html = sprintf($html, $class);
					$html .= $this->_template['field_label_prefix'];
					if ($field['type'] === 'checkbox') {
						// no label
					} else if (strpos($field['rules'], 'required') !== FALSE) {
						$html .= HtmlHelper::label(
							$this->_template['label_required_prefix'] . $field['label'] . $this->_template['label_required_suffix'],
							$this->_template['id_prefix'] . $field['name']
						);
					} else {
						$html .= HtmlHelper::label(
							$this->_template['label_optional_prefix'] . $field['label'] . $this->_template['label_optional_suffix'],
							$this->_template['id_prefix'] . $field['name']
						);
					}
					$html .= $this->_template['field_label_suffix'];
					$html .= $this->_template['field_input_prefix'];
					$html .= $input;
					if (!empty($field['note'])) {
						$html .= $this->_template['field_note_prefix'] . $field['note'] . $this->_template['field_note_suffix'];
					}
					if ($error) {
						$html .= $this->_template['field_error_prefix'] . $error . $this->_template['field_error_suffix'];
					}
					$html .= $this->_template['field_input_suffix'];
					$html .= $this->_template['field_group_suffix'];
				// Return
					return $html;
			}
			private function _generate_checkbox($field) {
				// value
					$value = (!empty($field['value'])) ? $field['value'] : '';
					if (!empty($_POST)) {
						$value = (isset($_POST[$field['name']])) ? $_POST[$field['name']] : '';
					}
				// Return Input
					$attributes = (!empty($value)) ? 'checked="checked"' : '';
					$input = HtmlHelper::checkbox($field['name'], '1', $field['label'], $attributes);
					return $this->_generate_group($field, $input);
			}
			private function _generate_checkboxes($field) {
				// value
					$value = (!empty($field['value'])) ? $field['value'] : '';
					if (!empty($_POST)) {
						$value = (isset($_POST[$field['name']])) ? $_POST[$field['name']] : '';
					}
				// Return Input
					$input = (!empty($field['options'])) ? HtmlHelper::checkboxes($field['name'], $field['options'], $value) : '';
					return $this->_generate_group($field, $input);
			}
			private function _generate_date($field) {
				$input = '';
				// month
					$value = (!empty($field['value']) && $field['value'] != '0000-00-00 00:00:00') ? date('m', strtotime($field['value'])) : date('m');
					$value = (isset($_POST[$field['name'].'_month'])) ? $_POST[$field['name'].'_month'] : $value;
					$options = array(
						'01' => 'January',
						'02' => 'February',
						'03' => 'March',
						'04' => 'April',
						'05' => 'May',
						'06' => 'June',
						'07' => 'July',
						'08' => 'August',
						'09' => 'September',
						'10' => 'October',
						'11' => 'November',
						'12' => 'December'
					);
					$input .= HtmlHelper::select($field['name'].'_month', $options, $value);
					$input .= ' ';
				// day
					$value = (!empty($field['value']) && $field['value'] != '0000-00-00 00:00:00') ? date('d', strtotime($field['value'])) : date('d');
					$value = (isset($_POST[$field['name'].'_day'])) ? $_POST[$field['name'].'_day'] : $value;
					$options = array(
						'01' => '1',
						'02' => '2',
						'03' => '3',
						'04' => '4',
						'05' => '5',
						'06' => '6',
						'07' => '7',
						'08' => '8',
						'09' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31'
					);
					$input .= HtmlHelper::select($field['name'].'_day', $options, $value);
					$input .= ' ';
				// year
					$value = (!empty($field['value']) && $field['value'] != '0000-00-00 00:00:00') ? date('Y', strtotime($field['value'])) : date('Y');
					$value = (isset($_POST[$field['name'].'_year'])) ? $_POST[$field['name'].'_year'] : $value;
					$options = array();
					for ($i=1970; $i<=date('Y'); ++$i) {
						$options[$i] = $i;
					}
					$input .= HtmlHelper::select($field['name'].'_year', $options, $value);

				return $this->_generate_group($field, $input);
			}
			private function _generate_datetime($field) {
				$input = '';
				// month
					$value = (!empty($field['value']) && $field['value'] != '0000-00-00 00:00:00') ? date('m', strtotime($field['value'])) : date('m');
					$value = (isset($_POST[$field['name'].'_month'])) ? $_POST[$field['name'].'_month'] : $value;
					$options = array(
						'01' => 'Jan',
						'02' => 'Feb',
						'03' => 'Mar',
						'04' => 'Apr',
						'05' => 'May',
						'06' => 'Jun',
						'07' => 'Jul',
						'08' => 'Aug',
						'09' => 'Sep',
						'10' => 'Oct',
						'11' => 'Nov',
						'12' => 'Dec'
					);
					$input .= HtmlHelper::select($field['name'].'_month', $options, $value);
					$input .= ' ';
				// day
					$value = (!empty($field['value']) && $field['value'] != '0000-00-00 00:00:00') ? date('d', strtotime($field['value'])) : date('d');
					$value = (isset($_POST[$field['name'].'_day'])) ? $_POST[$field['name'].'_day'] : $value;
					$options = array(
						'01' => '1',
						'02' => '2',
						'03' => '3',
						'04' => '4',
						'05' => '5',
						'06' => '6',
						'07' => '7',
						'08' => '8',
						'09' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31'
					);
					$input .= HtmlHelper::select($field['name'].'_day', $options, $value);
					$input .= ' ';
				// year
					$value = (!empty($field['value']) && $field['value'] != '0000-00-00 00:00:00') ? date('Y', strtotime($field['value'])) : date('Y');
					$value = (isset($_POST[$field['name'].'_year'])) ? $_POST[$field['name'].'_year'] : $value;
					$options = array();
					for ($i=1970; $i<=date('Y'); ++$i) {
						$options[$i] = $i;
					}
					$input .= HtmlHelper::select($field['name'].'_year', $options, $value);
				// divider
					$input .= $this->_template['datetime_divider'];
				// hour
					$value = (!empty($field['value']) && $field['value'] != '0000-00-00 00:00:00') ? date('g', strtotime($field['value'])) : date('g');
					$value = (isset($_POST[$field['name'].'_hour'])) ? $_POST[$field['name'].'_hour'] : $value;
					$options = array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12'
					);
					$input .= HtmlHelper::select($field['name'].'_hour', $options, $value);
					$input .= ' ';
				// minute
					$value = (!empty($field['value']) && $field['value'] != '0000-00-00 00:00:00') ? date('i', strtotime($field['value'])) : date('i');
					$value = (isset($_POST[$field['name'].'_minute'])) ? $_POST[$field['name'].'_minute'] : $value;
					$options = array(
						'01' => '01',
						'02' => '02',
						'03' => '03',
						'04' => '04',
						'05' => '05',
						'06' => '06',
						'07' => '07',
						'08' => '08',
						'09' => '09',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
						'32' => '32',
						'33' => '33',
						'34' => '34',
						'35' => '35',
						'36' => '36',
						'37' => '37',
						'38' => '38',
						'39' => '39',
						'40' => '40',
						'41' => '41',
						'42' => '42',
						'43' => '43',
						'44' => '44',
						'45' => '45',
						'46' => '46',
						'47' => '47',
						'48' => '48',
						'49' => '49',
						'50' => '50',
						'51' => '51',
						'52' => '52',
						'53' => '53',
						'54' => '54',
						'55' => '55',
						'56' => '56',
						'57' => '57',
						'58' => '58',
						'59' => '59'
					);
					$input .= HtmlHelper::select($field['name'].'_minute', $options, $value);
					$input .= ' ';
				// ante & post meridiem
					$value = (!empty($field['value']) && $field['value'] != '0000-00-00 00:00:00') ? date('A', strtotime($field['value'])) : date('A');
					$value = (isset($_POST[$field['name'].'_meridiem'])) ? $_POST[$field['name'].'_meridiem'] : $value;
					$options = array(
						'AM' => 'AM',
						'PM' => 'PM'
					);
					$input .= HtmlHelper::select($field['name'].'_meridiem', $options, $value);

				return $this->_generate_group($field, $input);
			}
			private function _generate_file($field) {
				$input = '';
				// TO-DO: FIX
				/*
				if (!empty($field['file']) && $this->_CI->uploads->file_exists($field['file'])) {
					if (strstr($field['file'], '.jpg') || strstr($field['file'], '.png') || strstr($field['file'], '.gif')) {
						$input .= '<p><a class="thumbnail" href="' . $this->_CI->uploads->get_link($field['file']) . no_cache() . '" target="_blank"><img src="' . $this->_CI->uploads->get_link($field['file']) . no_cache() . '" alt="' . $field['name'] . '" /></a></p>';
					} else {
						$input .= '<p><a href="' . $this->_CI->uploads->get_link($field['file']) . no_cache() . '" target="_blank">' . $this->_CI->uploads->get_link($field['file']) . '</a></p>';
					}
					if (empty(strpos($field['rules'], 'required') !== FALSE) {
						$input .= '<p><label class="checkbox">' . form_checkbox($field['name'].'_delete', 'true', FALSE) . ' <span>Delete ' . $field['label'] . '</span></label></p>';
					}
				}
				*/
				$attributes = $field['attributes'];
				$attributes['id'] = $this->_template['id_prefix'] . $field['name'];
				$input .= HtmlHelper::input_file($field['name'], '', $attributes);
				return $this->_generate_group($field, $input);
			}
			private function _generate_radios($field) {
				// value
					$value = (!empty($field['value'])) ? $field['value'] : '';
					$value = (isset($_POST[$field['name']])) ? $_POST[$field['name']] : $value;
				// Return Input
					$input = (!empty($field['options'])) ? HtmlHelper::radios($field['name'], $field['options'], $value) : '';
					return $this->_generate_group($field, $input);
			}
			private function _generate_select($field) {
				// value
					$value = (!empty($field['value'])) ? $field['value'] : '';
					$value = (isset($_POST[$field['name']])) ? $_POST[$field['name']] : $value;
				// attributes
					$attributes = $field['attributes'];
					$attributes['id'] = $this->_template['id_prefix'] . $field['name'];
					if (strpos($field['rules'], 'required') !== FALSE) {
						$attributes['required'] = 'required';
					}
				// Return Input
					$input = HtmlHelper::select($field['name'], $field['options'], $value, $attributes);
					return $this->_generate_group($field, $input);
			}
			private function _generate_text($field) {
				// value
					$value = (!empty($field['value'])) ? $field['value'] : '';
					$value = (isset($_POST[$field['name']])) ? $_POST[$field['name']] : $value;
					$value = stripslashes(trim($value));
				// Max Length
					$maxlength = '';
					if (strpos($field['rules'], 'max_length') !== FALSE) {
						$position = strpos($field['rules'], 'max_length') + 11;
						$maxlength = substr($field['rules'], $position);
						$position = strpos($maxlength, ']');
						$maxlength = substr($maxlength, 0, $position);
					}
				// Return Input
					$attributes = $field['attributes'];
					$attributes['data-validation'] = $this->_get_javascript_validation_rules($field['rules']);
					$attributes['id'] = $this->_template['id_prefix'] . $field['name'];
					if (!empty($maxlength)) {
						$attributes['maxlength'] = $maxlength;
					}
					if (strpos($field['rules'], 'required') !== FALSE) {
						$attributes['required'] = 'required';
					}
					$type = 'text';
					if ($field['type'] == 'password') {
						$attributes['autocomplete'] = 'off';
						$type = 'password';
					} else if (strpos($field['rules'], 'valid_email') !== FALSE) {
						$attributes['autocomplete'] = 'off';
						$type = 'email';
					} else if (strpos($field['rules'], 'valid_url') !== FALSE) {
						$attributes['autocomplete'] = 'off';
						$type = 'url';
					}
					$input = HtmlHelper::input($type, $field['name'], $value, $attributes);
					return $this->_generate_group($field, $input);
			}
			private function _generate_textarea($field) {
				// value
					$value = (!empty($field['value'])) ? $field['value'] : '';
					$value = (isset($_POST[$field['name']])) ? $_POST[$field['name']] : $value;
					$value = stripslashes(trim($value));
				// Return Input
					$attributes = $field['attributes'];
					$attributes['data-validation'] = $this->_get_javascript_validation_rules($field['rules']);
					$attributes['id'] = $this->_template['id_prefix'] . $field['name'];
					if (strpos($field['rules'], 'required') !== FALSE) {
						$attributes['required'] = 'required';
					}
					$input = HtmlHelper::textarea($field['name'], $value, $attributes);
					return $this->_generate_group($field, $input);
			}
			private function _get_javascript_validation_rules($rules) {
				// remove callbacks so they don't appear in data-validation attribute
				$array = explode('|', $rules);
				$data = '';
				if (!empty($array)) {
					foreach ($array as $rule) {
						if (substr($rule, 0, 9) != 'callback_') {
							if (strlen($data) > 0) {
								$data .= '|';
							}
							$data .= $rule;
						}
					}
				}
				return $data;
			}


		// ------------------------------------------------------------------------


		// Template
			private function _compile_template() {
				if ($this->_template == NULL) {
					$this->_template = $this->_default_template();
					return;
				}
				$this->temp = $this->_default_template();
				foreach (array('id_prefix', 'error_title', 'error_message_singular', 'error_message_plural', 'success_title', 'success_message', 'form_class', 'form_prefix', 'form_suffix', 'label_optional_prefix', 'label_optional_suffix', 'label_required_prefix', 'label_required_suffix', 'field_group_prefix', 'field_group_suffix', 'field_label_prefix', 'field_label_suffix', 'field_input_prefix', 'field_input_suffix', 'field_error_prefix', 'field_error_suffix', 'field_note_prefix', 'field_note_suffix', 'datetime_divider', 'submit_button_prefix', 'submit_button_suffix', 'submit_button_label') as $val) {
					if (!isset($this->_template[$val])) {
						$this->_template[$val] = $this->temp[$val];
					}
				}
			}
			private function _default_template() {
				return array (
					'id_prefix'					=> 'with-',
					'error_title'				=> 'Uh-oh!',
					'error_message_singular'	=> '%s error was found and needs to be corrected below!',
					'error_message_plural'		=> '%s errors were found and need to be corrected below!',
					'success_title'				=> 'Success!',
					'success_message'			=> 'Your information has been submitted.',
					'form_class'				=> 'with-form with-form-horizontal',
					'form_prefix'				=> '',
					'form_suffix'				=> '',
					'label_optional_prefix'		=> '',
					'label_optional_suffix'		=> ' <span>(optional)</span>',
					'label_required_prefix'		=> '',
					'label_required_suffix'		=> '',
					'field_group_prefix'		=> '<div class="field-group%s">',
					'field_group_suffix'		=> '</div>',
					'field_label_prefix'		=> '<div class="field-label">',
					'field_label_suffix'		=> '</div>',
					'field_input_prefix'		=> '<div class="field-input">',
					'field_input_suffix'		=> '</div>',
					'field_error_prefix'		=> '<p class="error-block"><strong>Error:</strong> ',
					'field_error_suffix'		=> '</p>',
					'field_note_prefix'			=> '<p class="note-block"><strong>Note:</strong> ',
					'field_note_suffix'			=> '</p>',
					'datetime_divider'			=> ' <br />',
					'submit_button_prefix'		=> '<div class="form-actions">',
					'submit_button_suffix'		=> '</div>',
					'submit_button_label'		=> 'Submit'
				);
			}

	}