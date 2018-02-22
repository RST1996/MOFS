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
	 	$query = "SELECT `created_by`,`name` FROM `acad_form` WHERE `id` = '$form_id'";
	 	if(	$res = mysqli_query($dbcon,$query))
	 	{
	 		$row = mysqli_fetch_assoc($res);
	 		if($_SESSION['current_user']['id'] == $row['created_by'])
	 		{
	 			$form_name = $row['name'];
				$select_query = "SELECT AVG(`acad_response`.`response`) as `avg`,`acad_form_questions`.`question`,`teacher`.`name`,`acad_form_questions`.`sub_cat_id` FROM `acad_response`,`teacher`,`acad_form_questions` WHERE`acad_response`.`form_id` = '$form_id' AND `teacher`.`id` = `acad_response`.`teacher_id` AND `acad_form_questions`.`id` = `acad_response`.`ques_id` GROUP BY `acad_response`.`ques_id`,`acad_response`.`teacher_id`";
				$teacher = array();
				$ques = array();
				$avg = array();
				if(	$res = mysqli_query($dbcon,$select_query))
				{
					$teacher = array();
					$teacher2 = array();
					$ques = array();
					$avg = array();
					while($row = mysqli_fetch_assoc($res))
					{
						
						$teacher[] = $row['name'];
						$ques[] = $row['question'];
						$avg[] = intval($row['avg']);
					}
					
				}
				
				$tech = "["."\"".$teacher[0]."\"";
						for($i=1;$i<sizeof($teacher);$i++)
						{
							$tech .=  ",\"".$teacher[$i]."\"";
						}
						
					$tech .= "]";
				$datasets = "";
				$data = "[".$avg[0];
				for($i=0;$i<sizeof($avg);$i++)
				{
				
				$datasets .= "{ label: '5',backgroundColor: 'blue',data: [2,5],},{ label: '4',backgroundColor: 'red',data: [1.4,3],},{ label: '3',backgroundColor: 'orange',data: [1,3],},{ label: '2',backgroundColor: 'green',data: [2,3],},{ label: '1',backgroundColor: 'purple',data: [4,5],},";
				
				}
				$data .= "]";
				
			}
	 		else
	 		{
?>
<script type="text/javascript">
		alert("Not allowed..!!");
		window.location.href="index.php";
</script>	
<?php
				die("You are not allowed here! :(");
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
	} 
	
       
?>
<!DOCTYPE html>
<html lang="en">
 <?php include("theme/head.php");?>
   
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
                <h3><?php echo $form_name." "; ?>Analysis </h3>
              </div>
            </div>
			<div class="clearfix"></div>
			<?php
			$query = "SELECT DISTINCT `acad_form_questions`.`question`,`acad_form_questions`.`id` FROM `acad_response`,`acad_form_questions` WHERE `acad_response`.`ques_id` = `acad_form_questions`.`id` AND `acad_response`.`form_id` = '$form_id'";
			if ($res1 = mysqli_query($dbcon,$query)) {
								if (mysqli_num_rows($res1) > 0) {
									while ($row1 = mysqli_fetch_assoc($res1)) {
										$id = $row1['id'];
									$query_response = "SELECT avg(`response`) as `avg`,`teacher_id`,`sub_id` FROM `acad_response` WHERE `ques_id` = '$id' AND `form_id` = '$form_id' GROUP by `teacher_id`,`sub_id`"; 	
									if ($res2 = mysqli_query($dbcon,$query_response)) {
								if (mysqli_num_rows($res2) > 0) {
									$response = array();
									$teacher = array();
									while ($row2 = mysqli_fetch_assoc($res2)) {
										$response[$row2['teacher_id']]= $row2['avg'];
										
									}
								}
									}
										
			?>
           <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h3><?php echo $row1['question'];?></h3>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="popChart"></canvas>
                  </div>
                </div>
              </div>

									<?php 
									}
								}
			}?>
            </div>
            
            <div class="clearfix"></div>
			</div>
        </div>
            
			<?php include("theme/footer.php");?>

        
      </div>
    </div>
			<?php include("theme/script.php");?>
    <script>
	
	var popCanvas = $("#popChart");
	var popCanvas = document.getElementById("popChart");
	var popCanvas = document.getElementById("popChart").getContext("2d");
	var barChart = new Chart(popCanvas, {
	type: 'bar',
	  data: {
		  labels: <?php echo $tech;?>,
		 datasets: [<?php echo $datasets;?>] ,
		
	  },
    
 
});

	</script>
</body>
</html>
<?php
	ob_end_flush();
?>