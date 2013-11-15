<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if ( ! function_exists('is_logged_in'))
	{
		function is_logged_in()
		{
			return (isset($_SESSION["user_id"])) ? true : false;
		}

	}

	if ( ! function_exists('logged_info'))
	{
		function logged_info()
		{
			$CI =& get_instance();
			return $CI->users->user_info($_SESSION["user_id"]);
		}

	}