<?php

	class Validation {

		// Returns FALSE if the string is empty.
		public static function required($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) > 0) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the two strings do not match.
		public static function matches($string1, $string2) {
			if (is_string($string1) === FALSE || is_string($string2) === FALSE) {
				return FALSE;
			}
			$string1 = trim($string1);
			$string2 = trim($string2);
			if ($string1 === $string2) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string is less than the desired length.
		public static function min_length($string, $length) {
			if (is_string($string) === FALSE || is_numeric($length) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) >= $length) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string is greater than the desired length.
		public static function max_length($string, $length) {
			if (is_string($string) === FALSE || is_numeric($length) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) <= $length) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string is not the desired length.
		public static function exact_length($string, $length) {
			if (is_string($string) === FALSE || is_numeric($length) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) === $length) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string is less than or equal to the desired value or not numeric.
		public static function greater_than($string, $value) {
			if (is_string($string) === FALSE || is_numeric($value) === FALSE || Validation::numeric($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (floatval($string) > $value) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string is greater than or equal to the desired value or not numeric.
		public static function less_than($string, $value) {
			if (is_string($string) === FALSE || is_numeric($value) === FALSE || Validation::numeric($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (floatval($string) < $value) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string contains anything other than alphabetical characters.
		public static function alpha($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			if (preg_match('/^[A-Za-z]+$/', $string)) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string contains anything other than alpha-numeric characters.
		public static function alpha_numeric($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			if (preg_match('/^[A-Za-z0-9]+$/', $string)) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string contains anything other than alpha-numeric characters, underscores or dashes.
		public static function alpha_dash($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			if (preg_match('/^[A-Za-z0-9_-]+$/', $string)) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string contains anything other than numeric characters.
		public static function numeric($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			if (is_numeric($string)) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string contains anything other than an integer.
		public static function integer($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			if (preg_match('/^[\-+]?[0-9]+$/', $string)) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string contains anything other than a decimal number.
		public static function decimal($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			if (preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $string)) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string contains anything other than a natural number: 0, 1, 2, 3, etc.
		public static function natural($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			if (preg_match('/^[0-9]+$/', $string)) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string does not contain a valid email address.
		public static function valid_email($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			$string = strtolower($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			if (preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $string)) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string contains anything other a than valid phone number.
		public static function valid_phone($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			$string = preg_replace('/[^0-9]/', '', $string);
			if (strlen($string) >= 10) {
				return TRUE;
			}
			return FALSE;
		}

		// Returns FALSE if the string contains anything other a than valid URL.
		public static function valid_url($string) {
			if (is_string($string) === FALSE) {
				return FALSE;
			}
			$string = trim($string);
			$string = strtolower($string);
			if (strlen($string) === 0) {
				return TRUE;
			}
			if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $string)) {
				return TRUE;
			}
			return FALSE;
		}

	}