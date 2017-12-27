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
	if(isset($_POST['submit'] ) && isset($_POST['name']) && isset($_POST['sub_name']) && isset($_POST['sub_type'])&& isset($_POST['sub_teacher_name']))
	{
			
				$form_id = $_POST['name'];
			
				$sub_name = $_POST['sub_name'];
				$sub_type = $_POST['sub_type'];
				$sub_teacher_name = $_POST['sub_teacher_name'];
				$multiple_techers = $_POST['multiple_techers'];
				$optional_sub = $_POST['optional_sub'];
				for ($i = 0; $i < sizeof($sub_name); $i++) {
						
				$sub_search_query = "SELECT `id`, `form_id` FROM `subjects` WHERE `sub_name`='$sub_name[$i]' AND `sub_type` = '$sub_type[$i]' AND `form_id` = '0' ";
					
				
				if($res = mysqli_query($dbcon,$sub_search_query))
				{
					$row = mysqli_fetch_assoc($res);
					$frm_id = $row['form_id'];
					$sub_id = $row['id'];
					if((mysqli_num_rows($res) == 0 ) || ($frm_id != 0))
					{
						//echo "<br />Not found <br />";
						$query = "INSERT INTO `subjects`(`id`, `sub_name`, `sub_type`, `optional_flag`, `multiple_teachers`, `form_id`) VALUES (NULL,'$sub_name[$i]','$sub_type[$i]','$optional_sub[$i]','$multiple_techers[$i]','$form_id')";
						
						 if ($result = mysqli_query($dbcon,$query)) {
							//echo "<br />subject insert Sucess";
							$sub_id = $dbcon->insert_id;
						} else {
							echo "Error";
						} 	 
					}
					else
					{
						
						//echo "<br /> ";
						// $sub_id = $row['id'];
						//echo "found at<br /> ";
						$update_query = "UPDATE `subjects` SET `form_id`='$form_id',`optional_flag` = '$optional_sub[$i]',`multiple_teachers` = '$multiple_techers[$i]' WHERE `id`='$sub_id' AND `sub_name`='$sub_name[$i]'";
						
						if ($result = mysqli_query($dbcon,$update_query)) {
							//echo "<br />subject update Sucess";
						} else {
							echo "Error";
						}	
					}
				}
				else {
					echo "Error....Please Contact Admin";
					}
				//	for ($j = 0; $j < sizeof($sub_teacher_name); $j++) {
						
					 $teacher_search_query = "SELECT `id` FROM `teacher` WHERE `name`= '$sub_teacher_name[$i]'";
					
				
						if($res1 = mysqli_query($dbcon,$teacher_search_query))
						{
							$row1 = mysqli_fetch_assoc($res1);
							$teacher_id = $row1['id'];
							if((mysqli_num_rows($res1) == 0 ) )
							{
								//echo "<br />Not found <br />";
								 $query = "INSERT INTO `teacher`(`id`, `name`) VALUES (NULL,'$sub_teacher_name[$i]')";
								
								 if ($result = mysqli_query($dbcon,$query)) {
									 $teacher_id = $dbcon->insert_id;
									//echo "<br />teacher Sucess";
								} else {
									echo "Error";
								} 	 
							}
							
						}
						else {
							echo "Error....Please Contact Admin";
						}
						$insert_assigned_teacher = "INSERT INTO `assigned_teachers`(`sub_id`, `teacher_id`) VALUES ('$sub_id','$teacher_id')";
						if ($result1 = mysqli_query($dbcon,$insert_assigned_teacher)) {
								echo "<script>alert('Subjects are Assigned Succesfully')</script>";
				
						} else {
								echo "Error";
							}
					//}
					
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
					
					<form class="form-horizontal form-label-left" method="POST" action="assign.php">

                      
                      <span class="section">Form Details</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Form Name <span class="required">*</span>
                        </label>
						<div class="col-md-6 col-sm-6 col-xs-12">
								
								<select class="form-control show-tick" id="name" name="name" required>
													<option value="">---SELECT FORM---</option>
													<?php
														$sel_query = "SELECT `id`, `name` FROM `acad_form` WHERE `created_by`='$user_id'";
														if ($res = mysqli_query($dbcon,$sel_query)) {
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
                     
					  <span class="section">Subject and Teachers Details</span>
					  <div id="dynamicInput">
						  <div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_name"  >Subject Name <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-8">
							  <input id="sub_name" class="form-control col-md-7 col-xs-12"  name="sub_name[]"  required="required" type="text" list="subjects" >
							  <datalist id="subjects">
									<?php
									$fetch_query = "SELECT `id`,`sub_name` FROM `subjects` WHERE 1";
									if ($res = mysqli_query($dbcon,$fetch_query)) {
										if (mysqli_num_rows($res) > 0) {
											while ($row = mysqli_fetch_assoc($res)) {
								?>
								<option value="<?php echo $row['sub_name']; ?>" >
								<?php
											}
										}
									}
								?>
								 </datalist>
							</div>
							 
						  </div>
						  <div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_name">Subject Type <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <select class="form-control" name="sub_type[]" required="required" class="form-control col-md-7 col-xs-12" >
										 <option></option>
										<option value="1">Theory</option>
										<option value="2">Practical</option>
							  </select>
							</div>
						  </div>
												
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_teacher_name">Subject Teacher Name <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <input id="sub_teacher_name" class="form-control col-md-7 col-xs-12"  name="sub_teacher_name[]"  required="required" type="text" list="teachers" />
								  <datalist id="teachers">
									<?php
									$fetch_query = "SELECT `id`,`name` FROM `teacher` WHERE 1";
									if ($res = mysqli_query($dbcon,$fetch_query)) {
										if (mysqli_num_rows($res) > 0) {
											while ($row = mysqli_fetch_assoc($res)) {
									?>
									<option value="<?php echo $row['name']; ?>" >
									<?php
												}
											}
										}
									?>
								 </datalist>
								</div>
								
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="optional_sub">Optional Subject <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <div id="optional_sub" class="btn-group" data-toggle="buttons">
									
									  <input type="radio" class="flat" name="optional_sub[]" value="0"> &nbsp; No&nbsp;
									
									  <input type="radio" class="flat" name="optional_sub[]" value="1"> Yes
									
								  </div>
								</div>
								
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="multiple_techers">Multiple Teachers <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <div id="multiple_techers" class="btn-group" data-toggle="buttons">
									
									  <input type="radio" class="flat" name="multiple_techers[]" value="0"> &nbsp; No&nbsp;
									
									  <input type="radio" class="flat" name="multiple_techers[]" value="1"> Yes
									
								  </div>
								</div>
								
							</div>
						</div>
						<hr width='80%'>
						<div class="item form-group" align="right">
							<div class="col-md-10 col-sm-10 col-xs-12" >
							  <button class="btn btn-app" onClick="addInput('dynamicInput');">
										<i class="glyphicon glyphicon-plus"><span class="docs-tooltip" data-toggle="tooltip" title="Add More">
									  </span></i>
							  </button> 
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