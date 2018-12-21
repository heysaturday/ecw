<?php

	class HtmlHelper {

		// ------------------------------------------------------------------------

		public static function alert($title, $message=FALSE, $type=FALSE, $close=FALSE) {
			$output = '<div class="alert';
			if (!empty($type)) {
				$output .= ' alert-' . $type;
			}
			$output .= '">';
			// TO-DO: FIX
			//if ($close === TRUE) {
			//	$output .= close_icon();
			//}
			$output .= '<strong>' . $title . '</strong>';
			if ($message !== FALSE) {
				$output .= ' ' . $message;
			}
			$output .= '</div>';
			return $output;
		}

		// ------------------------------------------------------------------------

		public static function video_clip($video_src, $poster_src='', $attributes='') {
			$output = '<div class="video-clip" data-video-src="' . $video_src . '"' . HtmlHelper::_attributes_to_string($attributes) . '>';
			if (!empty($poster_src)) {
				$output .= '<img src="' . $poster_src . '" />';
			}
			$output .= '</div>';
			return $output;
		}

		// ------------------------------------------------------------------------

		// Returns a <form> HTML string.
		public static function form_open($action='', $attributes='') {

			// If an action is not a full URL then turn it into one
			if (strpos($action, '://') === FALSE) {
				$action = sprintf(
					"%s://%s%s%s",
					isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
					$_SERVER['SERVER_NAME'],
					$_SERVER['REQUEST_URI'],
					$action
				);
			}

			if ($attributes == '') {
				$attributes = 'method="post"';
			}

			$output = '<form action="' . $action . '"';
			$output .= HtmlHelper::_attributes_to_string($attributes, TRUE);
			$output .= '>';
			return $output;
		}

		// Returns a <form> HTML string.
		public static function form_open_multipart($action='', $attributes='') {
			if (is_string($attributes)) {
				if (strlen($attributes) > 0) {
					$attributes .= ' ';
				}
				$attributes .= 'enctype="multipart/form-data"';
			} else {
				$attributes['enctype'] = 'multipart/form-data';
			}
			return HtmlHelper::form_open($action, $attributes);
		}

		// Returns a </form> HTML string.
		public static function form_close() {
			return '</form>';
		}

		// ------------------------------------------------------------------------

		// Returns a <fieldset> HTML string.
		public static function fieldset_open($legend_text='', $attributes='') {
			$output = '<fieldset';
			$output .= HtmlHelper::_attributes_to_string($attributes);
			$output .= '>';
			if ($legend_text != '') {
				$output .= '<legend>' . $legend_text . '</legend>';
			}
			return $output;
		}

		// Returns a </fieldset> HTML string.
		public static function fieldset_close() {
			return '</fieldset>';
		}

		// ------------------------------------------------------------------------

		// Returns a <label> HTML string.
		public static function label($label_text='', $for_id='', $attributes='') {
			$output = HtmlHelper::label_open($for_id, $attributes);
			$output .= $label_text;
			$output .= HtmlHelper::label_close();
			return $output;
		}

		// Returns a <label> HTML string.
		public static function label_open($for_id='', $attributes='') {
			$output = '<label';
			if ($for_id) {
				$output .= HtmlHelper::_attributes_to_string(array(
					'for' => $for_id
				));
			}
			$output .= HtmlHelper::_attributes_to_string($attributes);
			$output .= '>';
			return $output;
		}

		// Returns a </label> HTML string.
		public static function label_close() {
			return '</label>';
		}

		// Returns a <button> HTML string.
		public static function button($button_text='', $attributes='') {
			$output = '<button';
			$output .= HtmlHelper::_attributes_to_string($attributes);
			$output .= '>';
			$output .= $button_text;
			$output .= '</button>';
			return $output;
		}

		// ------------------------------------------------------------------------

		// Returns a <input> HTML string.
		public static function input($type='text', $name='', $value='', $attributes='') {
			$output = '<input';
			$output .= HtmlHelper::_attributes_to_string(array(
				'type' => $type,
				'name' => $name,
				'value' => $value
			));
			$output .= HtmlHelper::_attributes_to_string($attributes);
			$output .= ' />';
			return $output;
		}
		public static function input_checkbox($name='', $value='', $attributes='') {
			return HtmlHelper::input('checkbox', $name, $value, $attributes);
		}
		public static function input_email($name='', $value='', $attributes='') {
			return HtmlHelper::input('email', $name, $value, $attributes);
		}
		public static function input_file($name='', $value='', $attributes='') {
			return HtmlHelper::input('file', $name, $value, $attributes);
		}
		public static function input_hidden($name='', $value='', $attributes='') {
			return HtmlHelper::input('hidden', $name, $value, $attributes);
		}
		public static function input_password($name='', $value='', $attributes='') {
			return HtmlHelper::input('password', $name, $value, $attributes);
		}
		public static function input_radio($name='', $value='', $attributes='') {
			return HtmlHelper::input('radio', $name, $value, $attributes);
		}
		public static function input_search($name='', $value='', $attributes='') {
			return HtmlHelper::input('search', $name, $value, $attributes);
		}
		public static function input_tel($name='', $value='', $attributes='') {
			return HtmlHelper::input('tel', $name, $value, $attributes);
		}
		public static function input_text($name='', $value='', $attributes='') {
			return HtmlHelper::input('text', $name, $value, $attributes);
		}
		public static function input_url($name='', $value='', $attributes='') {
			return HtmlHelper::input('url', $name, $value, $attributes);
		}

		// ------------------------------------------------------------------------

		// Returns a <label><input> HTML string.
		public static function checkbox($name='', $value='', $label_text='', $attributes='') {
			$output = HtmlHelper::label_open();
			$output .= HtmlHelper::input_checkbox($name, $value, $attributes);
			$output .= ' ' . $label_text;
			$output .= HtmlHelper::label_close();
			return $output;
		}

		// Returns a <ul> HTML string.
		public static function checkboxes($name='', $options=array(), $value=array(), $attributes='') {
			if ($name AND strpos($name, '[]') === FALSE) {
				$name .= '[]';
			}
			if (is_string($value)) {
				$value = array($value);
			}
			$output = '<ul class="checkboxes"';
			$output .= HtmlHelper::_attributes_to_string($attributes);
			$output .= '>';
			if ($options) {
				foreach ($options as $key => $val) {
					$attr = (in_array($key, $value, FALSE)) ? 'checked="checked"' : '';
					$output .= '<li>';
					$output .= HtmlHelper::checkbox($name, $key, $val, $attr);
					$output .= '</li>';
				}
			}
			$output .= '</ul>';
			return $output;
		}

		// ------------------------------------------------------------------------

		// Returns a <label><input> HTML string.
		public static function radio($name='', $value='', $label_text='', $attributes='') {
			$output = HtmlHelper::label_open();
			$output .= HtmlHelper::input_radio($name, $value, $attributes);
			$output .= ' ' . $label_text;
			$output .= HtmlHelper::label_close();
			return $output;
		}

		// Returns a <ul> HTML string.
		public static function radios($name='', $options=array(), $value='', $attributes='') {
			$output = '<ul class="radios"';
			$output .= HtmlHelper::_attributes_to_string($attributes);
			$output .= '>';
			if ($options) {
				foreach ($options as $key => $val) {
					$attr = ($key == $value) ? 'checked="checked"' : '';
					$output .= '<li>';
					$output .= HtmlHelper::radio($name, $key, $val, $attr);
					$output .= '</li>';
				}
			}
			$output .= '</ul>';
			return $output;
		}

		// ------------------------------------------------------------------------

		// Returns a <select> HTML string.
		public static function select($name='', $options=array(), $value='', $attributes='') {
			$output = '<select';
			$output .= HtmlHelper::_attributes_to_string(array(
				'name' => $name
			));
			$output .= HtmlHelper::_attributes_to_string($attributes);
			$output .= '>';
			if ($options) {
				foreach ($options as $key => $val) {
					$output .= '<option';
					$output .= HtmlHelper::_attributes_to_string(array(
						'value' => $key
					));
					if ($key == $value) {
						$output .= ' selected="selected"';
					}
					$output .= '>';
					$output .= $val;
					$output .= '</option>';
				}
			}
			$output .= '</select>';
			return $output;
		}

		// ------------------------------------------------------------------------

		// Returns a <textarea> HTML string.
		public static function textarea($name='', $value='', $attributes='') {
			$output = '<textarea';
			$output .= HtmlHelper::_attributes_to_string(array(
				'name' => $name
			));
			$output .= HtmlHelper::_attributes_to_string($attributes);
			$output .= '>';
			$output .= $value;
			$output .= '</textarea>';
			return $output;
		}

		// ------------------------------------------------------------------------

		public static function _attributes_to_string($attributes, $formtag=FALSE) {

			$charset = 'UTF-8';

			if (is_string($attributes) AND strlen($attributes) > 0) {
				if ($formtag == TRUE AND strpos($attributes, 'method=') === FALSE) {
					$attributes .= ' method="post"';
				}
				if ($formtag == TRUE AND strpos($attributes, 'accept-charset=') === FALSE) {
					$attributes .= ' accept-charset="' . strtolower($charset) . '"';
				}
				return ' ' . $attributes;
			}

			if (is_object($attributes) AND count($attributes) > 0) {
				$attributes = (array)$attributes;
			}

			if (is_array($attributes) AND count($attributes) > 0) {
				$atts = '';
				if (!isset($attributes['method']) AND $formtag === TRUE) {
					$atts .= ' method="post"';
				}
				if (!isset($attributes['accept-charset']) AND $formtag === TRUE) {
					$atts .= ' accept-charset="' . strtolower($charset) . '"';
				}
				foreach ($attributes as $key => $val) {
					$val = htmlspecialchars($val);
					$val = str_replace(array("'", '"'), array("&#39;", "&quot;"), $val);
					$atts .= ' ' . $key . '="' . $val . '"';
				}
				return $atts;
			}

		}

		// ------------------------------------------------------------------------

	}