<?php
	/*
	This file contains all the functions realted to the user management module
	The OFS contains two types of user :
	1: Form creator
	*/
	function isLoggedin()
	{
		if(isset($_SESSION['current_user']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function login($username,$password)
	{
		global $dbcon;
		$query = 'SELECT * FROM `users` WHERE `email` = \''.$username.'\'';
		if($res = mysqli_query($dbcon,$query))
		{
			if(mysqli_num_rows($res) == 1)
			{
				$user = mysqli_fetch_assoc($res);
				$hash = $user['password'];
				if(verify_encrypt($password,$hash))
				{
					switch ($user['admin_role']) {
						case 1:
							$role = true;
							break;
						case 0:
							$role = false;
							break;
					}

					$_SESSION['current_user'] = array('id' => $user['id'], 'name' => $user['name'], 'admin_role' => $role,'email' => $user['email'], 'hash' => $hash );
					return true;
				}
				else
				{
					return false;
				}

			}
			else
			{
				return false;
			}
		}
		else
		{
			return mysqli_error($dbcon);
		}
	}
	function logout()
	{
		session_destroy();

	}
	function add_user($name,$email)
	{
		global $dbcon;
		$password = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890/*-+=!@');
		$password = substr($password,0,10);
		$pass_hash = encrypt($password);
		$query = 'INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin_role`) VALUES (NULL, \''. $name .'\', \''. $email .'\', \''. $pass_hash .'\', \'0\')';
		if($res = mysqli_query($dbcon,$query))
		{
			echo "Password  is: $password";
			if(reg_mail($name,$email,$password))
			{
				return true;
			}
			else
			{
				echo "Failed to send the registration mail.!";
			}
		}
		else
		{
			return false;
		}


	}

	function reg_mail($name,$email,$password)
	{
		return true;
	}
?>