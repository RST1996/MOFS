<?php
	function get_random_hex($length)
	{
		return bin2hex(openssl_random_pseudo_bytes($length));
	}

	function encrypt($string)
	{
		return password_hash($string, PASSWORD_DEFAULT);
	}

	function verify_encrypt($string,$hash)
	{
		return password_verify($string, $hash);
	}
?>