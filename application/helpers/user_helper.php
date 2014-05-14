<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('isLogin'))
{
	function isLogin()
	{
		$CI =& get_instance();
		$CI->load->library('session');
		if ($CI->session->userdata('login')) {
			return true;
		} else {
			return false;
		}
	}
}
if (!function_exists('getCurrentUsername'))
{
	function getCurrentUsername()
	{
		$CI =& get_instance();
		$CI->load->library('session');
		$username = '';
		return $CI->session->userdata('username');
	}
}
?>