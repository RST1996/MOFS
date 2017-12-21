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
                    <div id="wizard_verticle" class="form_wizard wizard_verticle">
                      <ul class="list-unstyled wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                           
                          </a>
                        </li>
                        
                      </ul>
                      <div id="step-1">
					  
						 						
						<h2 class="StepTitle">Step 1</h2>
                        <form method="POST" action="create_form.php" class="form-horizontal form-label-left">

                          <span class="section">Form Details</span>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3" for="name">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                              <input type="text" id="name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
							Description 
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<textarea id="description" type="textarea" name="description" class="form-control col-md-7 col-xs-12" rows="1"></textarea>
							</div>
                          </div>
                        </form>

                      </div>
                      <div id="step-2">
						<h2 class="StepTitle">Step 2</h2>
                        
						
                          <span class="section">Subject Details</span>

					    <div id="dynamicInput" align="center">
							  <div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
								Subject Name <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" type="text" name="sub_name[]" class="form-control col-md-7 col-xs-12"/>
								</div>
							  </div>
							  <br />
							  <br />
							  <div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Type</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <select class="form-control" name="sub_type[]">
									<option>Choose option</option>
									<option>Theory</option>
									<option>Practical</option>
									
								  </select>
								</div>
							</div>
							<br />
							  <br />
							  <div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Teacher</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <input id="name" type="text" name="sub_teacher_name[]" class="form-control col-md-7 col-xs-12"/>
								
								</div>
							</div>
						 </div>
							  <button class="btn btn-app" onClick="addInput('dynamicInput');">
									<i class="glyphicon glyphicon-plus"><span class="docs-tooltip" data-toggle="tooltip" title="Add More">
								  </span></i>
								</button>
								
                    
                      </div>
                      <div id="step-3">
                        <h2 class="StepTitle">Step 3</h2>
                        <form method="POST" action="create_form.php" class="form-horizontal form-label-left">

                          <span class="section">Preview Form</span>

                    
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
	

	<script>
		var counter = 1;
		
		function addInput(divName){
			 
				  var newdiv = document.createElement('div');
				  newdiv.innerHTML =  "  <br /><br /><div class='form-group' align='center'><label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Subject Name <span class='required'> *</span></label><div class='col-md-6 col-sm-6 col-xs-12'><input id='name' type='text' name='sub_name[]' class='form-control col-md-7 col-xs-12'/></div></div>  <br /><br />		  <div class='form-group'><label class='control-label col-md-3 col-sm-3 col-xs-12'>Subject Type</label><div class='col-md-6 col-sm-6 col-xs-12'> <select class='form-control' name='sub_type[]'><option>Choose option</option><option>Theory</option><option>Practical</option></select></div>							</div><br /><br /><div class='form-group'><label class='control-label col-md-3 col-sm-3 col-xs-12'>Subject Teacher</label><div class='col-md-6 col-sm-6 col-xs-12'><input id='name' type='text' name='sub_teacher_name[]' class='form-control col-md-7 col-xs-12'/></div>	</div>";
				  document.getElementById(divName).appendChild(newdiv);
				  counter++;
			 
		}
	</script>
  </body>
</html>

<?php
    ob_end_flush();
?>