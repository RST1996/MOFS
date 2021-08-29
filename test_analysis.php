<?php
	session_start();
	ob_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/utils.php';
	$form_id =4;
	//query to get all the questions 
	$ques_query  = "SELECT `id` FROM `acad_form_questions` ORDER BY sub_cat_id ASC , id ASC";    
	if($ques_res = mysqli_query($dbcon,$ques_query))
	{
		if(mysqli_num_rows($ques_res) > 0)
		{
			while($ques_rows = mysqli_fetch_assoc($ques_res))
			{
				$ques_id = $ques_rows['id'];
				//query to get the teacher, subject pair
				$pair_query = "SELECT `acad_response`.`teacher_id`,`acad_response`.`sub_id`,`subjects`.`sub_name`,`teacher`.`name` FROM `acad_response`,`teacher`,`subjects` WHERE `acad_response`.`form_id` = '$form_id' AND `acad_response`.`ques_id` = '$ques_id' AND `subjects`.`id` = `acad_response`.`sub_id` AND `teacher`.`id` = `acad_response`.`teacher_id` GROUP BY acad_response.teacher_id,acad_response.sub_id";
				//THE teacher,subject pair are the labels to be used
				if($pair_res  = mysqli_query($dbcon,$pair_query))
				{
					$label_array = array();
					//$dataset_array = array();
					$count_5_array = array();
					$count_4_array = array();
					$count_3_array = array();
					$count_2_array = array();
					$count_1_array = array();
					while($pair_rows = mysqli_fetch_assoc($pair_res))
					{
						$teacher_id = $pair_rows['teacher_id'];
						$sub_id = $pair_rows['sub_id'];
						$label_array[] = $pair_rows['name']."  (". $pair_rows['sub_name']." )";
						$dataset = array();
						$count_5_query  = "SELECT COUNT(*) as `c5` FROM `acad_response` WHERE form_id = '$form_id' AND ques_id = '$ques_id' AND teacher_id = '$teacher_id' AND sub_id = '$sub_id' AND response = '5'";
						if($count_5_res  = mysqli_query($dbcon,$count_5_query))
						{
							if($count_5_rows = mysqli_fetch_assoc($count_5_res))
							{
								$count_5 = $count_5_rows['c5'];
								$dataset[] = intval($count_5);
								$count_5_array[] = intval($count_5);
								//echo $count_5;
								//echo "<br/>";
							}
						}

						$count_4_query  = "SELECT COUNT(*) as `c4` FROM `acad_response` WHERE form_id = '$form_id' AND ques_id = '$ques_id' AND teacher_id = '$teacher_id' AND sub_id = '$sub_id' AND response = '4'";
						if($count_4_res  = mysqli_query($dbcon,$count_4_query))
						{
							if($count_4_rows = mysqli_fetch_assoc($count_4_res))
							{
								$count_4 = $count_4_rows['c4'];
								$dataset[] = intval($count_4);
								$count_4_array[] = intval($count_4);
								//echo $count_4;
								//echo "<br/>";
							}
						}

						$count_3_query  = "SELECT COUNT(*) as `c3` FROM `acad_response` WHERE form_id = '$form_id' AND ques_id = '$ques_id' AND teacher_id = '$teacher_id' AND sub_id = '$sub_id' AND response = '3'";
						if($count_3_res  = mysqli_query($dbcon,$count_3_query))
						{
							if($count_3_rows = mysqli_fetch_assoc($count_3_res))
							{
								$count_3 = $count_3_rows['c3'];
								$dataset[] = intval($count_3);
								$count_3_array[] = intval($count_3);
								//echo $count_3;
								//echo "<br/>";
							}
						}

						$count_2_query  = "SELECT COUNT(*) as `c2` FROM `acad_response` WHERE form_id = '$form_id' AND ques_id = '$ques_id' AND teacher_id = '$teacher_id' AND sub_id = '$sub_id' AND response = '2'";
						if($count_2_res  = mysqli_query($dbcon,$count_2_query))
						{
							if($count_2_rows = mysqli_fetch_assoc($count_2_res))
							{
								$count_2 = $count_2_rows['c2'];
								$dataset[] = intval($count_2);
								$count_2_array[] = intval($count_2);
								//echo $count_2;
								//echo "<br/>";
							}
						}

						$count_1_query  = "SELECT COUNT(*) as `c1` FROM `acad_response` WHERE form_id = '$form_id' AND ques_id = '$ques_id' AND teacher_id = '$teacher_id' AND sub_id = '$sub_id' AND response = '1'";
						if($count_1_res  = mysqli_query($dbcon,$count_1_query))
						{
							if($count_1_rows = mysqli_fetch_assoc($count_1_res))
							{
								$count_1 = $count_1_rows['c1'];
								$dataset[] = intval($count_1);
								$count_1_array[] = intval($count_1);
								//echo $count_1;
								//echo "<br/>";
							}
						}
						$dataset_array[] = json_encode($dataset);
						
					}
					print_r($label_array);
					echo "<br/>";
					print_r($dataset_array);
					echo "<br/>";
					echo json_encode($count_5_array);
					echo "<br/>";
					echo json_encode($count_4_array);
					echo "<br/>";
					echo json_encode($count_3_array);
					echo "<br/>";
					echo json_encode($count_2_array);
					echo "<br/>";
					echo json_encode($count_1_array);
				}
				echo "<br/>QUESTION CHANGED<br/>";		
			}
		}
		
	}
?>