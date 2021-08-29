<?php
	set_time_limit(0);
	session_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/csrf.class.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
    require_once 'bin/config/class.mail.php'; 
    require_once 'bin/config/recepients.mail.php';
    if(!isLoggedin())
	{
	   header('Location:login.php');
	   die('Un-ethical activity detected..!!  Do not try to such things here.'); 
	}
	if(isset($_POST['form_id']) && !empty($_POST['form_id']) && isset($_POST['email']) && !empty($_POST['email']))
	{
		$form_id = $_POST['form_id'];
		$email = $_POST['email'];
		$query = "SELECT `created_by`,`name` FROM `acad_form` WHERE `id` = '$form_id'";
	 	if(	$res = mysqli_query($dbcon,$query))
	 	{
	 		$row = mysqli_fetch_assoc($res);
	 		if($_SESSION['current_user']['id'] == $row['created_by'])
	 		{
	 			$hash = round(microtime(true)).get_random_hex(20);
	 			$query = "INSERT INTO `acad_receipients` (`resp_id`, `form_id`, `hash`, `percentage_group`, `submit_flag`) VALUES (NULL, '$form_id', '$hash', NULL, '0')";
	 			if($res = mysqli_query($dbcon,$query))
	 			{
	 				if(send_form($email,$hash))
	 				{
	 					echo "success";
	 				}
	 				else
	 				{
	 					echo "failed to mail -->".$email;
	 				}
	 			}
	 		}
	 		else
	 		{

				die("You are not allowed here! :(");
	 		}
	 	}
	 	else
	 	{

	 	}
	} 
?>