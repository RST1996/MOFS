<?php
	//print_r($_POST);
	require_once 'bin/config/dbcon.php';
	$form_id = $_GET['form_id'];
	
	$sub_name = $_POST['sub_name'];
	$sub_type = $_POST['sub_type'];
	$optional_flag = $_POST['optional_sub'];
	$multiple_teachers = $_POST['multiple_techers'];
	$sub_teacher_name = $_POST['sub_teacher_name'];

	$teacher_sucess = 1;
	for($i=0;$i<sizeof($sub_teacher_name); $i++){
		$teacher_search_query = "SELECT `id` FROM `teacher` WHERE `name`= '$sub_teacher_name[$i]'";
		if($res1 = mysqli_query($dbcon,$teacher_search_query))
		{
			$row1 = mysqli_fetch_assoc($res1);
			$teacher_id[$i] = $row1['id'];
			if((mysqli_num_rows($res1) == 0 ) )
			{ 
				
				$teacher_sucess =0;
				
			}
		} else {
			//echo "Error";
			$sucess =0;
		} 	 
	}
	
		
		if($teacher_sucess)
		{
				 $insert_query = "INSERT INTO `subjects`(`id`, `sub_name`, `sub_type`, `optional_flag`, `multiple_teachers`, `form_id`) VALUES (NULL,'$sub_name','$sub_type','$optional_flag','$multiple_teachers','$form_id')";
				if ($result = mysqli_query($dbcon,$insert_query)) {
							
				$sub_id = $dbcon->insert_id;
				for($i=0;$i<sizeof($teacher_id); $i++){
					$insert_assigned_teacher = "INSERT INTO `assigned_teachers`(`sub_id`, `teacher_id`) VALUES ('$sub_id','$teacher_id[$i]')";
					if ($result1 = mysqli_query($dbcon,$insert_assigned_teacher)) {
						
						$sucess =1;
					} else {
						//echo "Error";
						$sucess =0;
					} 
				}
			
				} else {
				//echo "Error";
				$sucess =0;
			}
		}
	else{
		$sucess = 0;
	}		
if($sucess)
{
	echo "task completed sucessfully";
}
else if(!$sucess && !$teacher_sucess){
	echo "teacher not found";
}
else
{
	echo "failed.... contact ADMIN";
}

?>