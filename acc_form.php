<?php
	session_start();
	ob_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
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
			<?php include("theme/leftsidebar.php");?>
			<?php include("theme/navbar.php");?>


		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Academic Feedback form</h3>
              </div>

              
			  
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>details</h2>
                    
					
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="user_container">
                     <p>Academic Form.</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Step 1<br />
                                              <small>Fill Your Details</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Theory Subjects Feedback</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Step 3<br />
                                              <small>Practical Subjects Feedback</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Step 4<br />
                                              <small>Overall Feedback</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      <div id="step-1">
                        <form class="form-horizontal form-label-left">

                         
						 
                          
						  <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Your Percentage in the last year/sem.</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select class="form-control">
								<option>Choose option</option>
								<option>Above 75%</option>
								<option>Between 60%And 70 %</option>
								<option>Between 50%And 59 %</option>
								<option>Below 50%</option>
							  </select>
							</div>
						  </div>
                          
						  
                        </form>

                      </div>
                      <div id="step-2">
					    <form class="form-horizontal form-label-left">
							<?php
							$fetch_query = "SELECT `id`, `question` FROM `acad_form_questions` WHERE `sub_cat_id` = '1' ";
							if ($res = mysqli_query($dbcon,$fetch_query)) {
								if (mysqli_num_rows($res) > 0) {
									while ($row = mysqli_fetch_assoc($res)) {
						?>
							<table class="table table-hover">
								<thead><b><?php echo $row['question'];?></b></thead>
								<tbody>
								<tr>
									<td></td>
									<td>5 - Mostly</td> 
									<td>4 -Quite often</td>
									<td>3-At times</td>
									<td>1-Hardly</td>
									<td>0- Never</td>
								</tr>
								<tr>
									<td>Staff 1</td> 
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat" name="responce_list[]"> 
											  
											</label>
										  </div>
										
										
									</td>
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat">  
											</label>
										  </div>
										
										
									</td>
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat">  
											</label>
										  </div>
										  
									</td>
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat">  
											</label>
										  </div>
										  
									</td>
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat">  
											</label>
										  </div>
										  
									</td>
									
								</tr>
								</tbody>
							</table>
						 <?php
									}
								}
							}
						 ?>
						 
						 
                    
                      </div>
                      <div id="step-3">
                        <?php
							$fetch_query = "SELECT `id`, `question` FROM `acad_form_questions` WHERE `sub_cat_id` = '2' ";
							if ($res = mysqli_query($dbcon,$fetch_query)) {
								if (mysqli_num_rows($res) > 0) {
									while ($row = mysqli_fetch_assoc($res)) {
						?>
							<table class="table table-hover">
								<thead><b><?php echo $row['question'];?></b></thead>
								<tbody>
								<tr>
									<td></td>
									<td>5 - Mostly</td> 
									<td>4 -Quite often</td>
									<td>3-At times</td>
									<td>1-Hardly</td>
									<td>0- Never</td>
								</tr>
								<tr>
									<td>Staff 1</td> 
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat" name="responce_list[]"> 
											  
											</label>
										  </div>
										
										
									</td>
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat">  
											</label>
										  </div>
										
										
									</td>
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat">  
											</label>
										  </div>
										  
									</td>
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat">  
											</label>
										  </div>
										  
									</td>
									<td>
										<div class="checkbox">
											<label>
											  <input type="checkbox" class="flat">  
											</label>
										  </div>
										  
									</td>
									
								</tr>
								</tbody>
							</table>
						 <?php
									}
								}
							}
						 ?>
						 
                        </form>

                    
                      </div>
                      <div id="step-4">
                        <h2 class="StepTitle">Step 4 Content</h2>
                        <p>
						
                        </p>
                        <p>
                        
						</p>
                        <p>
                        
						</p>
                      </div>

                    </div>
                    <!-- End SmartWizard Content -->


					
                  </div>
                </div>
              </div>
			
          </div>
        </div>
            
			<?php include("theme/footer.php");?>

        
      </div>
    </div>
			<?php include("theme/script.php");?>
	<script type="text/javascript">
	function delete_user($id)
	{
		
		var xhttp = new XMLHttpRequest();
		
        xhttp.onreadystatechange = function() {
			
        	if (this.readyState == 4 && this.status == 200) {
				
        		document.getElementById('user_container').innerHTML = this.responseText; 
        	}
        };
        xhttp.open("POST", "delete_user.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("del_id="+$id);
	}
</script>
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