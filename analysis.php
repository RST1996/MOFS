<?php
	require 'bin/config/dbcon.php';
	$form_id = 4;
	$pair_query = "SELECT `acad_summary_results`.`teacher_id`, `acad_summary_results`.`sub_id`, `teacher`.`name`, `subjects`.`sub_name` , AVG(`acad_summary_results`.`reponse`) as `avg`, COUNT(`acad_summary_results`.`reponse`) as `resp_count`  FROM `acad_summary_results`,`teacher`,`subjects` WHERE `acad_summary_results`.`ques_id` = 1  and `acad_summary_results`.`form_id` = '$form_id' and `teacher`.`id` = `acad_summary_results`.`teacher_id` and `acad_summary_results`.`sub_id` = `subjects`.`id` GROUP BY `acad_summary_results`.`teacher_id`, `acad_summary_results`.`sub_id`;";
	if($pair_res = mysqli_query($dbcon,$pair_query))
	{
		if(mysqli_num_rows($pair_res) > 0)
		{
?>
	<table border="1">
		<thead>
			<tr>
				<th>Sr.No. </th>
				<th>Name of Faculty</th>
				<th>Course</th>
				<th>Avg % score</th>
				<th>Faculty Index</th>
			</tr>
		</thead>
		<tbody>
<?php
			$i = 1;
			while ($pair = mysqli_fetch_assoc($pair_res))
			{
				$teacher_id = $pair['teacher_id'];
				$sub_id = $pair['sub_id'];
				$subject = $pair['sub_name'];
				$teacher = $pair['name'];

				$avg = $pair['avg'];
				$count = $pair['resp_count'];

				$count_10_query = "SELECT COUNT(*) as `c10` FROM `acad_summary_results` WHERE `teacher_id` = '$teacher_id' AND `sub_id` = '$sub_id' AND `ques_id` = '2' AND `form_id` = '$form_id' AND `reponse` = 10";
				if($count_10_res = mysqli_query($dbcon,$count_10_query))
				{
					$count_10_row = mysqli_fetch_assoc($count_10_res);
					$count_10 = $count_10_row['c10'];
				}

				$count_9_query = "SELECT COUNT(*) as `c9` FROM `acad_summary_results` WHERE `teacher_id` = '$teacher_id' AND `sub_id` = '$sub_id' AND `ques_id` = '2' AND `form_id` = '$form_id' AND `reponse` = 9";
				if($count_9_res = mysqli_query($dbcon,$count_9_query))
				{
					$count_9_row = mysqli_fetch_assoc($count_9_res);
					$count_9 = $count_9_row['c9'];
				}

				$count_8_query = "SELECT COUNT(*) as `c8` FROM `acad_summary_results` WHERE `teacher_id` = '$teacher_id' AND `sub_id` = '$sub_id' AND `ques_id` = '2' AND `form_id` = '$form_id' AND `reponse` = 8";
				if($count_8_res = mysqli_query($dbcon,$count_8_query))
				{
					$count_8_row = mysqli_fetch_assoc($count_8_res);
					$count_8 = $count_8_row['c8'];
				}

				$count_7_query = "SELECT COUNT(*) as `c7` FROM `acad_summary_results` WHERE `teacher_id` = '$teacher_id' AND `sub_id` = '$sub_id' AND `ques_id` = '2' AND `form_id` = '$form_id' AND `reponse` = 7";
				if($count_7_res = mysqli_query($dbcon,$count_7_query))
				{
					$count_7_row = mysqli_fetch_assoc($count_7_res);
					$count_7 = $count_7_row['c7'];
				}

				$count_6_query = "SELECT COUNT(*) as `c6` FROM `acad_summary_results` WHERE `teacher_id` = '$teacher_id' AND `sub_id` = '$sub_id' AND `ques_id` = '2' AND `form_id` = '$form_id' AND `reponse` = 6";
				if($count_6_res = mysqli_query($dbcon,$count_6_query))
				{
					$count_6_row = mysqli_fetch_assoc($count_6_res);
					$count_6 = $count_6_row['c6'];
				}

				$faculty_index = ( ($count_10 * 10) + ($count_9 * 9) + ($count_8 * 8) + ($count_7 * 7) + ($count_6 * 6) ) / ($count_10 + $count_9 + $count_8 + $count_7 + $count_6);
?>
			<tr>
				<td><?php echo $i++;  ?></td>
				<td><?php echo $teacher; ?></td>
				<td><?php echo $subject  ?></td>
				<td><?php echo number_format($avg, 2, '.', ',');  ?></td>
				<td><?php echo number_format($faculty_index, 2, '.', ','); ?></td>
			</tr>
<?php

			}
?>
		</tbody>
	</table>
	<button><a href="reports/?form_id=<?php echo $form_id; ?>" target="_blank" >Download report</a></button>
<?php
		}
		else
		{
			echo "Data not available";
		}
	}
?>