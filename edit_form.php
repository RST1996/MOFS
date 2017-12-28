<?php
	session_start();

	ob_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/csrf.class.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
    require_once 'bin/config/class.mail.php';
    require_once 'bin/config/registration.mail.php';
 
    
	if(!$_SESSION['current_user']['admin_role'])
	{
		header('Location:login.php');
	    die('Un-ethical activity detected..!!  Do not try to such things here.'); 
	}
	if(!isLoggedin())
	{
	   header('Location:login.php');
	   die('Un-ethical activity detected..!!  Do not try to such things here.'); 
	}
	$user_id = $_SESSION['current_user']['id'];
	
	
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
                <h3>Accademic Forms</h3>
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
						 <?php
														$sel_query = "SELECT `id`, `name` FROM `acad_form` WHERE `created_by`='$user_id'";
														if ($res = mysqli_query($dbcon,$sel_query)) {
															if (mysqli_num_rows($res) > 0) {
																while ($row = mysqli_fetch_assoc($res)) {
													?>
													
						 <div ><a class="btn btn-app" href="edit_acad_form.php?form_id=<?php echo $row['id'];?>">
                      <i class="fa fa-file"></i> <?php echo  $row['name'];?>
                    </a>
					<?php				
																}
															}
														}			
													?>
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