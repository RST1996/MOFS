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
	
	if(isset($_POST['submit']))
	{
		$resp_id = 1;
		
		$query = "INSERT INTO `acad_response` (`resp_id`, `teacher_id`, `sub_id`, `ques_id`, `response`) VALUES ";
		foreach($_POST['responce_list_th'] as $ques_id => $array)
		{
			foreach($array as $tech_id => $array2)
			{
				foreach($array2 as $sub_id => $array3)
				{
					foreach($array3 as $resopnse)
						{
							$query .= ",('$resp_id', '$tech_id', '$sub_id', '$ques_id', '$resopnse[0]')";
						
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
							$query .= ",('$resp_id', '$tech_id', '$sub_id', '$ques_id', '$resopnse[0]')";
						
						}
				}
			}
		}
		$query = preg_replace('/VALUES ,/', 'VALUES ', $query);
		if ($res = mysqli_query($dbcon,$query) ){
					
					echo "<script> alert('Form Submitted Successfully!!!'); </script>";
					unset($_POST);
					header( "refresh:1; url=index.php" );
				}
				else
				{
					echo "<script> alert('Failed.. CONTACT ADMIN'); </script>";
				}
}
			
			
?>

<!DOCTYPE html>
<html lang="en">
 <?php include("theme/head.php");?>
	<!-- Switchery -->
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
					  
                        <form method="POST" action="acad_form_response.php" id="demo-form2" class="form-horizontal form-label-left" data-parsley-validate>
						<div class="x_content" id="user_container">
							<h2>Theory Subjects</h2>
							<?php
						     
							$fetch_query = "SELECT `id`, `question` FROM `acad_form_questions` WHERE `sub_cat_id` = '1' ";
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
									<td>5 - Mostly</td> 
									<td>4 -Quite often</td>
									<td>3-At times</td>
									<td>2-Hardly</td>
									<td>1- Never</td>
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
									<td><input type="radio" required name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="5">
									
									</td>
									<td><input type="radio"  name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="4">
									
									</td>
									<td><input type="radio"  name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="3">
									
									</td>
									<td><input type="radio"  name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="2">
									
									</td>
									<td><input type="radio"  name="responce_list_th[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="1">
									
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
						     
							$fetch_query = "SELECT `id`, `question` FROM `acad_form_questions` WHERE `sub_cat_id` = '2' ";
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
									<td>5 - Mostly</td> 
									<td>4 -Quite often</td>
									<td>3-At times</td>
									<td>2-Hardly</td>
									<td>1- Never</td>
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
									
									<td><input type="radio" required name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="5">
									
									</td>
									<td><input type="radio"  name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="4">
									
									</td>
									<td><input type="radio"  name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="3">
									
									</td>
									<td><input type="radio"  name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="2">
									
									</td>
									<td><input type="radio"  name="responce_list_pr[<?php echo $ques_id?>][<?php echo $tech_id ?>][<?php echo $sub_id ?>][]" value="1">
									
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
	
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
			
  </body>
</html>

<?php
    ob_end_flush();
?>