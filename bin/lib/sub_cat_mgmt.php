<?php
	function add_subject_cat($name)
	{
		global $dbcon;
		$query = "INSERT INTO `sub_category` (`id`, `name`) VALUES (NULL, '$name')";
		if($res = mysqli_query($dbcon,$query))
		{
			//echo "Password  is: $password";
			return true;
		}
		else
		{
			return false;
		}

	}
?>