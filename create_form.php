<?php
	session_start();
	ob_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/csrf.class.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
	if(!isLoggedin())
	{
	   header('Location:login.php');
	   die('Un-ethical activity detected..!!  Do not try to such things here.'); 
	}		
	$csrf = new csrf();
 	// Generate Token Id and Valid
	$token_id = $csrf->get_token_id();
	$token_value = $csrf->get_token($token_id);	 
	// Generate Random Form Names
	$form_names = $csrf->form_names(array('name', 'description'), false);
	if(isset($_POST[$form_names['name']], $_POST[$form_names['description']], $_POST['create_form']) && !empty($_POST[$form_names['name']]) && !empty($_POST[$form_names['description']])) {
        // Check if token id and token value are valid.
        if($csrf->check_valid('post')) 
        {                
			$form_insert_stmt = $dbcon->prepare("INSERT INTO `acad_form`(`id`, `name`, `description`, `status`, `created_by`) VALUES (NULL,?,?,'0',?)");
			$form_insert_stmt->bind_param("sss", $name, $description,$user_id);
			// Get the Form Variables.
			$name = $_POST[$form_names['name']];
        	$description = $_POST[$form_names['description']];
        	$user_id = $_SESSION['current_user']['id'];
        	if($form_insert_stmt->execute())
			{
				$form_id = $form_insert_stmt->insert_id;
?>
	<script type="text/javascript">
		alert("Form successfully created..! Redirecting to edit form... ");
		window.location.href="edit_acad_form.php?form_id=<?php echo $form_id; ?>";
	</script>
<?php			
			}
			else
			{
				$error_msg = $stmt->error;
?>
	<script type="text/javascript">
		alert("Failed to create form.. :( ! Something went wrong");
		window.location.href =".";
	</script>
<?php
			}
			$form_insert_stmt->close();
        }
        $form_names = $csrf->form_names(array('sub_id', 'ques'), true);
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
                <h3>Create Accademic Form</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					<form class="form-horizontal form-label-left" method="POST" action="create_form.php">
           <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />

                      <span class="section">Form Details</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12"  name="<?php echo $form_names['name']; ?>"  required="required" type="text" >
						  
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description"  name="<?php echo $form_names['description']; ?>" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                      </div>
                      
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
							
							<input type="submit" class="btn btn-success" name="create_form" value="Create Form"> 
							
							
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