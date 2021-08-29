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
	if (isset($_SESSION['hash']) && !empty($_SESSION['hash']) && isset($_POST['next2']) )
	{
		$resp_id = $_SESSION['resp_id'];
		foreach($_POST['teacher'] as $sub_id => $teacher_array)
		{
			foreach( $teacher_array as $teacher_id )
			{
					$insert_query = "INSERT INTO `acad_sub_selection`(`resp_id`, `sub_id`, `teacher_id`) VALUES ('$resp_id','$sub_id','$teacher_id')";
					if(	$res = mysqli_query($dbcon,$insert_query))
					{
						header( "refresh:1; url=acad_form_response.php" );
					}else
					{
						?>
	<script type="text/javascript">
		alert("Failed ...");
		
	</script>
<?php
					}
			}
		}
	}
	if (isset($_SESSION['hash']) && !empty($_SESSION['hash']) && isset($_POST['next']) &&isset($_POST['subjects']) ) {
		
		$query = "SELECT `resp_id`, `form_id`, `submit_flag` FROM `acad_receipients` WHERE `hash` = '$hash'";
	 	if(	$res = mysqli_query($dbcon,$query))
	 	{
			$row = mysqli_fetch_assoc($res);
			$resp_id = $row['resp_id'];
			
			$form_id = $row['form_id'];
			$_SESSION['form_id'] = $form_id;
			$percentage = $_POST['percentage'];
			$update_query = "UPDATE `acad_receipients` SET `percentage_group`='$percentage' WHERE `resp_id`= '$resp_id' AND `form_id` = '$form_id' AND `submit_flag` = '0'";
			
			if(	$resl = mysqli_query($dbcon,$update_query))
			{
				$subjects = $_POST['subjects'];
				
				
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
					  
                        <form method="POST" action="acad_form_update.php" id="demo-form2" class="form-horizontal form-label-left" data-parsley-validate>
						<div class="x_content" id="user_container">
							<p>Feedback Form.</p>
						
							  <h2 class="StepTitle">Select Teachers</h2>
						<table class="table" width="100%">
						  
						  <tbody>
							
								
							<?php
								
								foreach($subjects as $sub_id )
								{
									$select_teacher = "SELECT `subjects`.`id`,`subjects`.`sub_name`,`teacher`.`id` as `t_id`,`teacher`.`name`,`subjects`.`multiple_teachers` FROM `subjects`,`assigned_teachers`,`teacher` WHERE `assigned_teachers`.`sub_id` = '$sub_id' AND `assigned_teachers`.`sub_id` = `subjects`.`id` AND `assigned_teachers`.`teacher_id` = `teacher`.`id`";
									if(	$res1 = mysqli_query($dbcon,$select_teacher))
									{
										$count = mysqli_num_rows($res1);
										if($count > 1)
										{
											$row1 = mysqli_fetch_assoc($res1);
											if($row1['multiple_teachers']){
												$type = "checkbox";
											}
											else
											{
												$type = "radio";
											}
?>
								<tr>
									<td rowspan="<?php echo $count;?>"><?php echo $row1['sub_name'] ?></td>
									<td><input type="<?php echo $type; ?>" value="<?php echo $row1['t_id']?>" name="teacher[<?php echo $sub_id ?>][]"> <?php echo $row1['name'] ?></td>
								</tr>
<?php			
											while($row1 = mysqli_fetch_assoc($res1))
											{
?>
								<tr>
									<td><input type="<?php echo $type; ?>" value="<?php echo $row1['t_id']?>" name="teacher[<?php echo $sub_id ?>][]"> <?php echo $row1['name'] ?></td>
								</tr>				
<?php
											}
										}
										else
										{
											$row1 = mysqli_fetch_assoc($res1);
?>
								<tr>
									<td><?php echo $row1['sub_name'] ?></td>
									<td><input type="checkbox" value="<?php echo $row1['t_id']?>" name="teacher[<?php echo $sub_id ?>][]" readonly checked> <?php echo $row1['name'] ?></td>
									
								</tr>
<?php
										}
									}
								}
							?>
							</tbody>
							</table>
							  <div class="ln_solid"></div>
							  <div class="form-group" align="right">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								  <input type="submit" class="btn btn-primary" name="next2" value="NEXT" />
								</div>
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
								}
		}
	} 
    ob_end_flush();
?>