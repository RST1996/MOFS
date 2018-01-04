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

	
	if(isset($_POST['name'], $_POST['email'], $_POST['department'], $_POST['add_user']) && !empty($_POST['name']) && !empty($_POST['email'])&& !empty($_POST['department'])) {
       
           $name = $_POST['name'];
           $email = $_POST['email'];
		   $department = $_POST['department'];
           $insert_form = "INSERT INTO `teacher`(`id`, `name`, `email`, `department`) VALUES (NULL,'$name','$email','$department')";
		   if ($res = mysqli_query($dbcon,$insert_form) ){
				echo "<script> alert('Teacher added Successfully!!!'); </script>";
			}
			else
			{
				echo "<script> alert('Falied to add Teacher'); </script>";
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
                <h3>Add Teachers</h3>
              </div>

              
			  
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Enter the details here</h2>
                    
					
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					
					<form method="POST" action="add_teacher.php" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
						Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input id="name" type="text" name="name" class="form-control col-md-7 col-xs-12"/>
                        </div>
                      </div>
					 
					 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email Id  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<input id="email" type="email" name="email" class="form-control col-md-7 col-xs-12"/>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department">
						Department <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control show-tick" id="department" name="department" required>
													<option value="">---SELECT DEPARTMENT---</option>
													<?php
														$dep_sel_query = "SELECT `id`, `name` FROM `department`";
														if ($res = mysqli_query($dbcon,$dep_sel_query)) {
															if (mysqli_num_rows($res) > 0) {
																while ($row = mysqli_fetch_assoc($res)) {
													?>
													<option value="<?php echo $row['id']; ?>"><?php echo $row['name'];  ?></option>
													<?php				
																}
															}
														}			
													?>
												</select>
                        </div>
                      </div>
					  
					  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						
						  <button class="btn btn-primary" type="reset" onclick="reset()">Reset</button>
                          <button type="submit" name="add_user" class="btn btn-success">Submit</button>
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
<script>
function reset() {
    document.getElementById("myForm").reset();
}
</script>
   
  </body>
</html>
<?php
	ob_end_flush();
?>