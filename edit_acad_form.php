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
	if (isset($_GET['form_id']) && !empty($_GET['form_id'])) {
	 	$form_id = mysqli_real_escape_string($dbcon,$_GET['form_id']);
	 	$query = "SELECT `created_by`,`name` FROM `acad_form` WHERE `id` = '$form_id'";
	 	if(	$res = mysqli_query($dbcon,$query))
	 	{
	 		$row = mysqli_fetch_assoc($res);
	 		if($_SESSION['current_user']['id'] == $row['created_by'])
	 		{
	 			$form_name = $row['name'];
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
                    <div class="clearfix">Form details</div>
                  </div>
                  <div class="x_content">
					<span class="section">Subject and Teachers Details</span>
					<div id="dynamicInput">
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_name"  >Subject Name <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-8">
							  <input id="sub_name" class="form-control col-md-7 col-xs-12"  name="sub_name[]"  required="required" type="text" list="subjects" >
							  <datalist id="subjects">
																	 </datalist>
							</div>
							 
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