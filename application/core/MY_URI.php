<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_URI extends CI_URI {
	function _filter_uri($str) {
		if ($str != '' && $this -> config -> item('permitted_uri_chars') != '' && $this -> config -> item('enable_query_strings') == FALSE) {
			// preg_quote() in PHP 5.3 escapes -, so the str_replace() and addition of - to preg_quote() is to maintain backwards
			
			if (!preg_match("|^[" . str_replace(array('\\-', '\-'), '-', preg_quote($this -> config -> item('permitted_uri_chars'), '-')) . "]+$|i", $str)) {
				show_error('The URI you submitted has disallowed characters.', 400);
			}

			$str = rawurldecode($str);// 增加的代码
		}

		// Convert programatic characters to entities
		$bad = array('$', '(', ')', '%28', '%29');
		$good = array('$', '(', ')', '(', ')');

		return str_replace($bad, $good, $str);
	}

}
