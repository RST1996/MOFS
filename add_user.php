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

	$csrf = new csrf();
 	// Generate Token Id and Valid
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);	 
	// Generate Random Form Names
	$form_names = $csrf->form_names(array('name', 'email'), false);
	if(isset($_POST[$form_names['name']], $_POST[$form_names['email']], $_POST['add_user']) && !empty($_POST[$form_names['name']]) && !empty($_POST[$form_names['email']])) {
        // Check if token id and token value are valid.
        if($csrf->check_valid('post')) {
                // Get the Form Variables.
                $name = $_POST[$form_names['name']];
                $email = $_POST[$form_names['email']];
 
                // Form Function Goes Here
                if(add_user($name,$email))
                {
                	echo "<script> alert(User added Successfully!!!); </script>";
                }
                else
                {
                	echo "<script> alert(Falied to add user); </script>";
                }
        }
        // Regenerate a new random value for the form.
        $form_names = $csrf->form_names(array('name', 'email'), true);
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
                <h3>Add Users</h3>
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
					
					<form method="POST" action="add_user.php" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						<input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
						Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input id="name" type="text" name="<?= $form_names['name']; ?>" class="form-control col-md-7 col-xs-12"/>
                        </div>
                      </div>
					 
					 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email Id  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<input id="email" type="email" name="<?= $form_names['email']; ?>" class="form-control col-md-7 col-xs-12"/>
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