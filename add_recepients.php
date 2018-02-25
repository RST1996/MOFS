<?php
	session_start();
	ob_start();
	//print_r($_POST);
	//print_r($_FILES);
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/csrf.class.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
    // require_once 'bin/config/class.mail.php'; 
    // require_once 'bin/config/recepients.mail.php';
	if(!isLoggedin())
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
	 			//$form_id = $_GET['form_id'];
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

	$csrf = new csrf();
 	// Generate Token Id and Valid
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);	 
	// Generate Random Form Names
	$form_names = $csrf->form_names(array('file'), false);
	if(isset($_FILES[$form_names['file']], $_POST['add_recepients']) && !empty($_FILES[$form_names['file']]) ) {
        // Check if token id and token value are valid.
        if($csrf->check_valid('post')) {
                // Get the Form Variables.
        		$file_ip_name = $form_names['file'];
                $file = $_FILES[$file_ip_name];
                //print_r($file);
                if($file['type'] == 'application/vnd.ms-excel')
                {
                	$file_name = $file['tmp_name'];
                	ini_set('auto_detect_line_endings',TRUE);
					$handle = fopen($file_name, "r");
					$flag = 0;
					$invalid_entry = array();
					$email_array = array();
					while(($filesop = fgetcsv($handle, 500, ",")) !== false)
					{
						if($flag = 0){
							$flag = 1;
							continue;
						}
						$email = $filesop[0];
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$email_array[] = $email;
						} else {
							$invalid_entry[] = $email;
						}
					}

					//print_r($email_array);

?>
		<script src="vendors/jquery/dist/jquery.min.js"></script>
		<script src="vendors/BlockUI/jquery.blockUI.js"></script>
		<script type="text/javascript">
			function send_form(email,item,length)
			{
				//alert(email);
				var xhttp = new XMLHttpRequest();
				var form_id = <?php echo $form_id; ?>;
		        xhttp.onreadystatechange = function() {
		        	if (this.readyState == 4 && this.status == 200) {
						
		        		console.log(this.responseText); 
		        		if(item+1 == length){
		        			//$.unblockUI();
		        			alert("Form successfully send to all the recepients!!");
		        		}
		        	}
		        };
		        xhttp.open("POST", "receipients.php", true);
		        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		        xhttp.send("form_id="+form_id+"&email="+email);
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function() { 
				//$('body').blockUI({ message: '<h1><img src="assets/images/loader.gif" /> Processing plz wait it will take some time...</h1>' });
				var email = <?php echo json_encode($email_array); ?>;
				//alert(email);
				for(var i in email)
				{
					send_form(email[i],i,email.length);
				}
				
			});
		</script>
<?php

                }
                else
                {
                	echo "Only submit the data by using the sample file.";
                }
             
 
                // Form Function Goes Here
        }
        // Regenerate a new random value for the form.
        $form_names = $csrf->form_names(array('file'), true);
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
                <h3><?php echo $form_name; ?></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Recepients</h2>				
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  	<div class="row clearfix">
						<div class="col-md-4" align="center">
							<div class="form-group">
								<p>Download the required format</p>
							</div>
						</div>
						<div class="col-md-2" align="center">
							<div class="form-group">
							<form method="get" action="format.csv">
								<button type="submit" class="btn btn-primary waves-effect">Download!</button>
							</form>
							</div>
						</div>
					</div>
                    <br />
					<form method="POST" action="add_recepients.php?form_id=<?php echo $form_id; ?>" onsubmit="confirm('Are you sure you want to send form to the users listed in the sheet attached')" class="form-horizontal form-label-left" enctype="multipart/form-data">
						<input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
						<div class="form-group">
                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
								Recepients Emails <span class="required">*</span>
                        	</label>
                        	<div class="col-md-6 col-sm-6 col-xs-12">
								<input accept=".csv" id="file" type="file" name="<?= $form_names['file']; ?>" class="form-control col-md-7 col-xs-12" required/>
                        	</div>
                      	</div>
                      	<div class="form-group">
		                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		                      	<button type="submit" name="add_recepients" class="btn btn-success">Send Form</button>
		                    </div>
                      	</div>
					</form>
                  </div>
                </div>
              </div>
            </div>             
          </div>
        </div>	
		<?php include("theme/footer.php");?>
      </div>
    </div>
			<?php include("theme/script.php");?>
</body>
</html>
<?php
	ob_end_flush();
?>