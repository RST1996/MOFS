<?php
	session_start();
	ob_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
	
	if(!isset($_GET['token'])&& empty($_GET['token']))
	{
	   header('Location:login.php');
	   die('Un-ethical activity detected..!!  Do not try to such things here.'); 
	}
	
	
	
	if (isset($_GET['token']) && !empty($_GET['token'])) {
	 	$hash = $_GET['token'];
		$_SESSION['hash'] = $hash;
	 	$query = "SELECT `acad_form`.`name`,`acad_form`.`description`,`resp_id`, `acad_receipients`.`form_id`, `submit_flag` FROM `acad_form`,`acad_receipients` WHERE `hash` = '$hash' AND `form_id` = `acad_form`.`id`";
	 	if(	$res = mysqli_query($dbcon,$query))
	 	{
	 		$row = mysqli_fetch_assoc($res);
			if($row['submit_flag'] == 0)
			{
				$form_name = $row['name'];
				$desc = $row['description'];
				$form_id = $row['form_id'];
				$_SESSION['resp_id'] = $row['resp_id'];
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
                <h3><?php echo $form_name?></h3>
              </div> 
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
					  <div class="x_title">
						<h2><?php echo $desc?></h2>
						<div class="clearfix"></div>
					  </div>
					  
                        <form method="POST" action="acad_form_update.php" id="demo-form2" class="form-horizontal form-label-left" data-parsley-validate>
						<div class="x_content" id="user_container">
							<h3>Feedback Form.</h3>
						
							  <div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Your Percentage in the last year/sem.</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <select name="percentage" class="form-control" required>
									<option value="">---SELECT OPTION---</option>
									<option value="1">Above 75%</option>
									<option value="2">Between 60%And 70 %</option>
									<option value="3">Between 50%And 59 %</option>
									<option value="4">Below 50%</option>
														
								  </select>
								</div>
							  </div>
							  
                      </div>
					  <div class="x_content" id="user_container">
						<h2 class="StepTitle">Select Subjects </h2>
						<table class="table" width="100%">
						  
						  <tbody>
							
								
							<?php
								$select_sub_query = "SELECT `id`, `sub_name`, `sub_type`, `optional_flag`, `multiple_teachers` FROM `subjects` WHERE `form_id` = '$form_id' ORDER BY `sub_type`";
									if ($result = mysqli_query($dbcon,$select_sub_query)) {
										if (mysqli_num_rows($result) > 0) {
											while ($row1 = mysqli_fetch_assoc($result)) {
													$sub_id = $row1['id'];
													if($row1['optional_flag'])
													{
											?>
									<tr>
										<td><input type="checkbox" value="<?php echo $sub_id ?>" name="subjects[]"> <?php echo $row1['sub_name'] ?></td>
										
									</tr>
<?php											
													}
												else{

													?>
									<tr>
										<td><input type="checkbox" value="<?php echo $sub_id ?>" checked hidden name="subjects[]"> <?php echo $row1['sub_name'] ?></td>
										
									</tr>
											
												<?php
												}
											}
										}
									}
							?>
							</tbody>
							</table>
							 <div class="ln_solid"></div>
							  <div class="form-group" align="right">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								  <input type="submit" class="btn btn-primary" value="NEXT" name="next" type="button"/>
								</div>
							  </div>
                      </div>
					  
					  
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
	else
	{
		?>
	<script type="text/javascript">
		alert("Form Already Filled......");
		window.location.href="index.php";
	</script>
<?php
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

    ob_end_flush();
?>