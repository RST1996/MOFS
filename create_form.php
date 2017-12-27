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
	
		
	if(isset($_POST['submit'] ) && isset($_POST['name']) )
	{
			$name = $_POST['name'];
			$desc = $_POST['description'];
			$user_id = $_SESSION['current_user']['id'];
			$insert_form = "INSERT INTO `acad_form`(`id`, `name`, `description`, `status`, `created_by`) VALUES (NULL,'$name','$desc','0','$user_id')";
			
			if ($res = mysqli_query($dbcon,$insert_form)) {
				$last_id = $dbcon->insert_id;
				
				echo "<script>alert('Form Created Succesfully')</script>";
				
			} else {
					echo "Failed to create a form";
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
                <h3>Add Accademic Form</h3>
              </div>

              
			  
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>A form to collect a Students Academic Feedback</h2>
                    
					
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					
					<form class="form-horizontal form-label-left" method="POST" action="create_form.php">

                      
                      <span class="section">Form Details</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12"  name="name"  required="required" type="text" >
						  
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description"  name="description" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                      </div>
                      
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
							<input type="submit" class="btn btn-primary" name="cancel" value="Cancel" />
							<input type="submit" class="btn btn-success" name="submit" value="Submit"> 
							
							
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

   <script>
		var counter = 1;
		
		function addInput(divName){
			 
				  var newdiv = document.createElement('div');
				  newdiv.innerHTML =  "<hr width='80%'><div class='item form-group'>                  <label class='control-label col-md-3 col-sm-3 col-xs-12' for='sub_name'>Subject Name <span class='required'>*</span>           </label>                        <div class='col-md-6 col-sm-6 col-xs-12'>                          <input id='sub_name' class='form-control col-md-7 col-xs-12'  name='sub_name[]'  required='required' type='text' list='subjects' >							  <datalist id='subjects'>									<?php									$fetch_query = 'SELECT `id`,`sub_name` FROM `subjects` WHERE 1';									if ($res = mysqli_query($dbcon,$fetch_query)) {										if (mysqli_num_rows($res) > 0) {											while ($row = mysqli_fetch_assoc($res)) {								?>								<option value='<?php echo $row['sub_name']; ?>' >								<?php											}										}									}?>								 </datalist>     </div>                      </div>                      <div class='item form-group'>                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='sub_name'>Subject Type <span class='required'>*</span>                        </label>                        <div class='col-md-6 col-sm-6 col-xs-12'>                          <select class='form-control' name='sub_type[]'>									<option value=''>Choose option</option>									<option value='1' >Theory</option>									<option value='2' >Practical</option>		 </select>                        </div>                      </div>					   <div class='item form-group'>                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='sub_teacher_name'>Subject Teacher Name <span class='required'>*</span>                        </label>                        <div class='col-md-6 col-sm-6 col-xs-12'>                          <input id='sub_teacher_name' class='form-control col-md-7 col-xs-12'  name='sub_teacher_name[]'  required='required' type='text' list='teachers' />								  <datalist id='teachers'>									<?php									$fetch_query = 'SELECT `id`,`name` FROM `teacher` WHERE 1';									if ($res = mysqli_query($dbcon,$fetch_query)) {										if (mysqli_num_rows($res) > 0) {											while ($row = mysqli_fetch_assoc($res)) {									?>									<option value='<?php echo $row['name']; ?>' >									<?php												}											}										}									?>								 </datalist>                        </div>						                  </div> ";
				  document.getElementById(divName).appendChild(newdiv);
				  counter++;  
			 
		}
	</script>
  </body>
</html>
<?php
	ob_end_flush();
?>