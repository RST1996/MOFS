<?php
	session_start();

	ob_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/csrf.class.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
    require_once 'bin/config/class.mail.php';
    require_once 'bin/config/registration.mail.php';
 
    if(!isLoggedin())
	{
	   header('Location:login.php');
	   die('Un-ethical activity detected..!!  Do not try to such things here.'); 
	}
	if(!$_SESSION['current_user']['admin_role'])
	{
		header('Location:login.php');
	    die('Un-ethical activity detected..!!  Do not try to such things here.'); 
	}
	if (isset($_GET['form_id']) && !empty($_GET['form_id'])) {
	 	$form_id = mysqli_real_escape_string($dbcon,$_GET['form_id']);
		
	?>
	
<!DOCTYPE html>
<html lang="en">
 <?php include("theme/head.php");?>
 <?php include("theme/script.php");?>
   
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
			<?php include("theme/leftsidebar.php");?>
			<?php include("theme/navbar.php");?>


		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>OVERALL ANALYSIS </h3>
              </div>
            </div>
			<div class="clearfix"></div>
			<?php
			$pair_query = "SELECT `acad_summary_results`.`teacher_id`, `acad_summary_results`.`sub_id`, `teacher`.`name`, `subjects`.`sub_name` , AVG(`acad_summary_results`.`reponse`) as `avg`, COUNT(`acad_summary_results`.`reponse`) as `resp_count`  FROM `acad_summary_results`,`teacher`,`subjects` WHERE `acad_summary_results`.`ques_id` = 1  and `acad_summary_results`.`form_id` = '$form_id' and `teacher`.`id` = `acad_summary_results`.`teacher_id` and `acad_summary_results`.`sub_id` = `subjects`.`id` GROUP BY `acad_summary_results`.`teacher_id`, `acad_summary_results`.`sub_id` ORDER BY `subjects`.`sub_type`";
	if($pair_res = mysqli_query($dbcon,$pair_query))
	{
		if(mysqli_num_rows($pair_res) > 0)
		{
?>
<div class="row">
              <div>
                <div class="x_panel">
                  <div class="x_title">
                    
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                  
	<table class="table">
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
				<div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						
						  <button class="btn btn-success"><a href="reports/?form_id=<?php echo $form_id; ?>" target="_blank" >Download report</a></button>
                        </div>
                      </div>

	
	</div>
                </div>
              </div>
              </div>
<?php
		}
		else
		{
			echo "Data not available";
		}
	}
?>
			
			<div class="page-title">
              <div class="title_left">
                <h3>QUESTION WISE ANALYSIS </h3>
              </div>
            </div>
			
			
			
	<?php
	
		$ques_query  = "SELECT `id`,`question` FROM `acad_form_questions` ORDER BY sub_cat_id ASC , id ASC";    
	if($ques_res = mysqli_query($dbcon,$ques_query))
	{
		if(mysqli_num_rows($ques_res) > 0)
		{
			while($ques_rows = mysqli_fetch_assoc($ques_res))
			{
				$ques_id = $ques_rows['id'];
				$question = $ques_rows['question'];
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
						//$label_array[] = $pair_rows['name']."  (". $pair_rows['sub_name']." )";
						$label_array[] = $pair_rows['name'];
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
						
					$tech = "["."\"".$label_array[0]."\"";
						for($i=1;$i<sizeof($label_array);$i++)
						{
							$tech .=  ",\"".$label_array[$i]."\"";
						}
						
					$tech .= "]";
					
	
				}
				
				//echo "<br/>QUESTION CHANGED<br/>";	
?>
 <div class="row">
              <div>
                <div class="x_panel">
                  <div class="x_title">
                    <h5><?php echo $question;?></h5>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="popChart<?php echo $ques_id;?>"></canvas>
                  </div>
                </div>
              </div>
              </div>
			  <script>
	
	var popCanvas = $("#popChart<?php echo $ques_id;?>");
	var popCanvas = document.getElementById("popChart<?php echo $ques_id;?>");
	var popCanvas = document.getElementById("popChart<?php echo $ques_id;?>").getContext("2d");
	var barChart = new Chart(popCanvas, {
	type: 'bar',
	  data: {
		  labels: <?php echo json_encode($label_array);?>,
		 datasets: [{
                label: '5',
                backgroundColor: "blue",
                data: <?php echo json_encode($count_5_array);?>
            }, {
                
                label: '4',
                backgroundColor: "green",
                data: <?php echo json_encode($count_4_array);?>
            }, {
                label: '3',
                backgroundColor: "orange",
                data: <?php echo json_encode($count_3_array);?>
            }, {
                label: '2',
                backgroundColor: "red",
                data: <?php echo json_encode($count_2_array);?>
            }, {
                label: '1',
                backgroundColor: "purple",
                data: <?php echo json_encode($count_1_array);?>
            }],
	  },
    
 
});

	</script>
			   
<?php				
			}
		}
		
	}
	}
	 	else
	 	{
?>
	<script type="text/javascript">
		alert("Failed to identify the form...");
		window.location.href="index.php";
	</script>
<?php
	 	}
	
	
       
?>
			
            
            <div class="clearfix"></div>
			</div>
        </div>
            
			<?php include("theme/footer.php");?>

        
      </div>
    </div>
	
			
			<??>
   
</body>
</html>
<?php
	ob_end_flush();
?>