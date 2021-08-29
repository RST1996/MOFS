<?php
	
	/*
	This file contains all the functions realted to the form management module
	
	*/
	
	function calculate_sum($resp_id,$form_id)
	{
		global $dbcon;
		$select_query = "SELECT `resp_id`,`teacher_id`,`sub_id`,sum( `response`) as `sum`,  `acad_response`.`form_id`,`subjects`.`sub_type` FROM `acad_response`,`subjects` WHERE `subjects`.`id` = `acad_response`.`sub_id` AND  `subjects`.`form_id` = `acad_response`.`form_id` AND `acad_response`.`form_id` = '$form_id' AND `resp_id` = '$resp_id' GROUP By `teacher_id`,`sub_id`";
		if ($res = mysqli_query($dbcon,$select_query)) {
			if (mysqli_num_rows($res) > 0) {
				$insert_query = "INSERT INTO `acad_summary_results` (`resp_id`, `teacher_id`, `sub_id`, `ques_id`, `form_id`, `reponse`) VALUES ";
				while ($row = mysqli_fetch_assoc($res)) {
					$sub_type = $row['sub_type'];
					$sub_id = $row['sub_id'];
					$teacher_id = $row['teacher_id'];
					$sum = $row['sum'];
					
					if($sub_type == '1')
					{
						$percentage = ($sum /100)*100;
						$insert_query .= ",('$resp_id', '$teacher_id', '$sub_id', '1', '$form_id', '$percentage')";
					}
					else
					{						
						$percentage = ($sum /75)*100;
						$insert_query .= ",('$resp_id', '$teacher_id', '$sub_id', '2', '$form_id', '$percentage')";
					}
					
					
				}
				$insert_query = preg_replace('/VALUES ,/', 'VALUES ', $insert_query);
				if ($res = mysqli_query($dbcon,$insert_query)) {
						return "sucess";
					}
					else
					{
							return "failed";
					} 
			}
		}
										
	}
	
?>