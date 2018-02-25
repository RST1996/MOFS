<?php
	session_start();
	ob_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
	
	if(!isset($_SESSION['hash']))
	{
	   header('Location:login.php');
	   die('Un-ethical activity detected..!!  Do not try to such things here.'); 
	}
	$hash = $_SESSION['hash'];
	$form_id = $_SESSION['form_id'] ;
	$resp_id = $_SESSION['resp_id']; 
	
	if(isset($_POST['submit']))
	{
		
		$query = "INSERT INTO `acad_summary_results` (`resp_id`, `teacher_id`, `sub_id`, `ques_id`, `reponse`,`form_id`) VALUES ";
		foreach($_POST['responce_list_th'] as $ques_id => $array)
		{
			foreach($array as $tech_id => $array2)
			{
				foreach($array2 as $sub_id => $array3)
				{
					foreach($array3 as $resopnse)
						{
							
							$query .= ",('$resp_id', '$tech_id', '$sub_id', '$ques_id', '$resopnse[0]','$form_id')";
						
						}
						
				}
			}
		}
		foreach($_POST['responce_list_pr'] as $ques_id => $array)
		{
			foreach($array as $tech_id => $array2)
			{
				foreach($array2 as $sub_id => $array3)
				{
					foreach($array3 as $resopnse)
						{
							$query .= ",('$resp_id', '$tech_id', '$sub_id', '$ques_id', '$resopnse[0]','$form_id')";
						
						}
				}
			}
		}
		$query = preg_replace('/VALUES ,/', 'VALUES ', $query);
		if ($res = mysqli_query($dbcon,$query) ){
			
					$update_query = "UPDATE `acad_receipients` SET `submit_flag`='1' WHERE `resp_id` = '$resp_id' AND `form_id` = '$form_id' AND `hash` = '$hash'";
					if ($res = mysqli_query($dbcon,$update_query) ){
					echo "<script> alert('Form Submitted Successfully!!!'); </script>";
					unset($_POST);
					header( "refresh:1; url=index.php" );
					}
				}
				else
				{echo "Error description: " . mysqli_error($dbcon);
					//echo "<script> alert('Failed.. CONTACT ADMIN'); </script>";
				}
}
			
			
?>

<!DOCTYPE html>
<html lang="en">
 <?php include("theme/head.php");?>
	<!-- Switchery -->
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
			<?php include("theme/leftsidebar_student_view.php");?>
			<?php include("theme/navbar_student_view.php");?>


		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                
              </div> 
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
					  <div class="x_title">
						
						<div class="clearfix"></div>
					  </div>
					  <h2>Your Feedback is as follows </h2>
					  <table class="table table-hover" width="50%">
								
					  <?php
							$select_query = "SELECT `teacher`.`name`,`subjects`.`sub_name`,`acad_summary_results`.`reponse` FROM `acad_summary_results`,`teacher`,`subjects` WHERE `acad_summary_results`.`resp_id` = '$resp_id' AND `teacher`.`id` = `acad_summary_results`.`teacher_id`  AND `subjects`.`id` =`acad_summary_results`.`sub_id` AND `acad_summary_results`.`form_id` = '$form_id'";
							if ($ress = mysqli_query($dbcon,$select_query)) {
							if (mysqli_num_rows($ress) > 0) {
								
								while ($rows = mysqli_fetch_assoc($ress)) {
									
					  ?>
								<tr>
									<td><?php echo $rows['name'];?><br /><p><font size="1" color="blue">(<?php echo $rows['sub_name'];?>)</font></p></td>
									<td><?php echo $rows['reponse']."%"?></td>
								</tr>
								<?php
								}
								}
								}?>
							</table>
                        <form method="POST" action="acad_form_final.php" id="demo-form2" class="form-horizontal form-label-left" data-parsley-validate>
						<div class="x_content" id="user_container">
							<h2>Theory Subjects</h2>
							<?php
						     
							$fetch_query = "SELECT * FROM `acad_summary_ques` WHERE `sub_cat_id` = '1'  AND `id` = '3'";
							if ($res = mysqli_query($dbcon,$fetch_query)) {
								if (mysqli_num_rows($res) > 0) {
									while ($row = mysqli_fetch_assoc($res)) {
										$ques_id = $row['id'];
										
						?>
							<table class="table table-hover" width="100%">
								<thead><b><?php echo $row['question'];?></b></thead>
								<tbody>
								<tr>
									<td></td>
									<td>O - outstanding</td> 
									<td>E - Excellent</td>
									<td>V - Very Good</td>
									<td>G -  Good</td>
									<td>S - Satisfactory</td>
									<td>N - Not satisfactory</td>
								</tr>
								<?php 
									$select_sub_query = "SELECT `teacher`.`id` as `tech_id`,`teacher`.`name`,`subjects`.`id` as `sub_id`,`subjects`.`sub_name`,`sub_category`.`id`,`acad_sub_selection`.`resp_id` FROM `subjects`,`teacher`,`acad_sub_selection`,`acad_receipients`,`sub_category` WHERE `acad_receipients`.`hash` = '$hash'  AND `acad_receipients`.`resp_id` =  `acad_sub_selection`.`resp_id` AND `teacher`.`id` = `acad_sub_selection`.`teacher_id` AND `subjects`.`id` = `acad_sub_selection`.`sub_id` AND `sub_category`.`id` = `subjects`.`sub_type` AND `subjects`.`sub_type` ='1'";
									if ($result = mysqli_query($dbcon,$select_sub_query)) {
										if (mysqli_num_rows($result) > 0) {
											while ($row1 = mysqli_fetch_assoc($result)) {
												$tech_id = $row1['tech_id'];
												$sub_id = $row1['sub_id'];
												$resp_id = $row1['resp_id'];
								?>
								<tr>
								
									<td><?php echo $row1['name'];?><br /><p><font size="1" color="blue">(<?php echo $row1['sub_name'];?>)</font></p></td> 
									
									
									<td><input type="radio" required name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="10">
									
									</td>
									<td><input type="radio"  name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="9">
									
									</td>
									<td><input type="radio"  name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="8">
									
									</td>
									<td><input type="radio"  name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="7">
									
									</td>
									<td><input type="radio"  name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="6">
									
									</td>
									<td><input type="radio"  name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="5">
									
									</td>
											
								</tr>
								<?php
											}
										}
									}
									?>
								</tbody>
							</table>
						 <?php
									}
								}
							}
						 ?>
						 
						 
                    
							  
                      </div>
					  <div class="x_content">
							<h2>Practical Subjects</h2>
							<?php
						     
							$fetch_query = "SELECT * FROM `acad_summary_ques` WHERE `sub_cat_id` = '2'  AND `id` = '4'";
							if ($res = mysqli_query($dbcon,$fetch_query)) {
								if (mysqli_num_rows($res) > 0) {
									while ($row = mysqli_fetch_assoc($res)) {
										$ques_id = $row['id'];
						?>
							<table class="table table-hover" width="100%">
								<thead><b><?php echo $row['question'];?></b></thead>
								<tbody>
								<tr>
									<td></td>
									<td>O - outstanding</td> 
									<td>E - Excellent</td>
									<td>V - Very Good</td>
									<td>G -  Good</td>
									<td>S - Satisfactory</td>
									<td>N - Not satisfactory</td>
								</tr>
								<?php 
									$select_sub_query = "SELECT `teacher`.`id` as `tech_id`,`teacher`.`name`,`subjects`.`id` as `sub_id`,`subjects`.`sub_name`,`sub_category`.`id`,`acad_sub_selection`.`resp_id` FROM `subjects`,`teacher`,`acad_sub_selection`,`acad_receipients`,`sub_category` WHERE `acad_receipients`.`hash` = '$hash'  AND `acad_receipients`.`resp_id` =  `acad_sub_selection`.`resp_id` AND `teacher`.`id` = `acad_sub_selection`.`teacher_id` AND `subjects`.`id` = `acad_sub_selection`.`sub_id` AND `sub_category`.`id` = `subjects`.`sub_type` AND `subjects`.`sub_type` ='2'";
									if ($result = mysqli_query($dbcon,$select_sub_query)) {
										if (mysqli_num_rows($result) > 0) {
											while ($row1 = mysqli_fetch_assoc($result)) {
												$tech_id = $row1['tech_id'];
												$sub_id = $row1['sub_id'];
												$resp_id = $row1['resp_id'];
												
								?>
								<tr>
								
									<td><?php echo $row1['name'];?><br /><p><font size="1" color="blue">(<?php echo $row1['sub_name'];?>)</font></p></td> 
									
									<td><input type="radio" required name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="10">
									
									</td>
									<td><input type="radio"  name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="9">
									
									</td>
									<td><input type="radio"  name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="8">
									
									</td>
									<td><input type="radio"  name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="7">
									
									</td>
									<td><input type="radio"  name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="6">
									
									</td>
									<td><input type="radio"  name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="5">
									
									</td>
											
								</tr>
								<?php
											}
										}
									}
									?>
								</tbody>
							</table>
						 <?php
									}
								}
							}
						 ?>
						 
						 
                    
							  
                      </div>
					  <div class="ln_solid"></div>
							  <div class="form-group" align="center">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								  <input class="btn btn-primary" type="submit" value="Submit" name="submit" />
								</div>
							  </div>
					  </form>
                  </div>
                </div>
              </div>
			
          </div>
        </div>
            
			<?php include("theme/footer.php");?>

        
      </div>
    </div>
    </div>
			<?php include("theme/script.php");?>
	


<!-- jQuery Smart Wizard -->
    <script src="vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
	 <script src="vendors/iCheck/icheck.min.js"></script>
	 <script src="vendors/switchery/dist/switchery.min.js"></script>
	
			
  </body>
</html>

<?php
    ob_end_flush();
?>