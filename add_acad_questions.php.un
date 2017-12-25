<?php
	session_start();

	ob_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/csrf.class.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
    require_once 'bin/lib/acad_ques_mgmt.php';
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
	$form_names = $csrf->form_names(array('sub_id', 'ques'), false);
	if(isset($_POST[$form_names['sub_id']], $_POST[$form_names['ques']], $_POST['add_ques']) && !empty($_POST[$form_names['sub_id']]) && !empty($_POST[$form_names['ques']])) {
        // Check if token id and token value are valid.
        if($csrf->check_valid('post')) {
                // Get the Form Variables.
                $sub_id = $_POST[$form_names['sub_id']];
                $ques = $_POST[$form_names['ques']];
 
                // Form Function Goes Here
                if(add_ques($sub_id,$ques))
                {
                	echo "<script> alert('Question added Successfully!!!'); </script>";
                }
                else
                {
                	echo "<script> alert('Falied to add question :( '); </script>";
                }
        }
        // Regenerate a new random value for the form.
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
                <h3>Add Academic Form Questions</h3>
              </div>

              
			  
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--h2></h2-->
                    
					
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					
					<form method="POST" action="add_acad_questions.php" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						<input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_cat">
						Subject Category <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select id="subject_cat" type="text" name="<?= $form_names['sub_id']; ?>" class="form-control col-md-7 col-xs-12" required>
							<option value=""> --SELECT A SUBJECT CATEGORY--</option>
<?php
	$sub_cat_fetch_query = "SELECT * FROM `sub_category`";
	if($res = mysqli_query($dbcon,$sub_cat_fetch_query))
	{
		while($row = mysqli_fetch_assoc($res))
		{
			$value = $row['id'];
			$sub_cat = $row['name'];
?>
							<option value="<?php echo $value; ?>"><?php echo $sub_cat; ?></option>
<?php
		}
	}
?>
						</select>
                        </div>
                      </div>
					 
					 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ques">Question  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<textarea id="ques" type="text" name="<?= $form_names['ques']; ?>" class="form-control col-md-7 col-xs-12" required ></textarea>
                        </div>
                      </div>
					  
					  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						
						  <button class="btn btn-primary" type="reset" onclick="reset()">Reset</button>
                          <button type="submit" name="add_ques" class="btn btn-success">Submit</button>
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