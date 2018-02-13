<?php
	session_start();
    ob_start();
    require_once 'bin/config/dbcon.php';
    require 'bin/lib/utils.php';
    require 'bin/lib/user_mgmt.php';
	if(!isLoggedin())
	{
	   header('Location:login.php');
	   die('Un-ethical activity detected..!!  Do not try to such things here.');
	}
	
	include("theme/main.php");

	ob_end_flush();
?>