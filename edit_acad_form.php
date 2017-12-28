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
                <h3>Edit Accademic Form</h3>
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
					
					<form class="form-horizontal form-label-left" method="POST" action="edit_acad_form.php">

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
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="optional_sub">Optional Subject <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  
								  <input type="radio"  name="optional_sub[]" value="0"> &nbsp; No&nbsp;
									
									  <input type="radio"  name="optional_sub[]" value="1"> Yes
									
								 
								</div>
								
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="multiple_techers">Multiple Teachers <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									  <label for="chkNo">
										<input type="radio" id="chkNo" name="multiple_techers[]" value="1" />
										No
										</label>
									  <label for="chkYes">
										<input type="radio" id="chkYes" name="multiple_techers[]" value="0" />
										Yes
										</label>
									
								</div>
								
							</div>
						</div>
						
						<div id="formdv" style="display: none">
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
</div>
<div id="formdv2" style="display: none">
<?php $dynamic_id = 0;?>
    <div id="dynamicInputSingleTeachers">
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_teacher_name">Subject Multiple Teacher Name <span class="required">*</span>
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
							</div>
							<?php $dynamic_id++;?>
							<hr width='80%'>
							<div class="item form-group" align="right">
								<div class="col-md-10 col-sm-10 col-xs-12" >
								  <button class="btn btn-app" onClick="addInputmultiple('dynamicInputSingleTeachers');">
											<span class="docs-tooltip" data-toggle="tooltip" title="Add More">Add More Teacher
										  </span>
								  </button> 
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
							<input type="submit" class="btn btn-primary" name="reset" value="Reset"  onclick="reset();" />
							
							
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
    document.getElementById("dynamicInput").reset();
}
</script>
<script type="text/javascript">
    $(function () {
        $("input[name='multiple_techers[]']").click(function () {
            if ($("#chkNo").is(":checked")) {
                $("#formdv").show();
            } else {
                $("#formdv").hide();
            }
			if ($("#chkYes").is(":checked")) {
                $("#formdv2").show();
            } else {
                $("#formdv2").hide();
            }
        });
    });
</script>
<script>
		var count = 1;
		
		function addInputmultiple(divName){
			 
				  var newdiv = document.createElement('div');
				  newdiv.innerHTML =  "<div class='item form-group'>                  <label class='control-label col-md-3 col-sm-3 col-xs-12' for='sub_name'>Subject Name <span class='required'>*</span>           </label>                        <div class='col-md-6 col-sm-6 col-xs-12'>                          <input id='sub_name' class='form-control col-md-7 col-xs-12'  name='sub_name[]'  required='required' type='text' list='subjects' >							  <datalist id='subjects'>																 </datalist>     </div>                      </div>    <div id='formdv' style='display: none'>  <div class='item form-group'>	<label class='control-label col-md-3 col-sm-3 col-xs-12' for='sub_teacher_name'>Subject Teacher Name <span class='required'>*</span></label>	<div class='col-md-6 col-sm-6 col-xs-12'> <input id='sub_teacher_name' class='form-control col-md-7 col-xs-12'  name='sub_teacher_name[]'  required='required' type='text' list='teachers' />	  <datalist id='teachers'><?php									$fetch_query = 'SELECT `id`,`name` FROM `teacher` WHERE 1';				if ($res = mysqli_query($dbcon,$fetch_query)) {										if (mysqli_num_rows($res) > 0) {										while ($row = mysqli_fetch_assoc($res)) {									?>									<option value='<?php echo $row['name']; ?>' >									<?php												}											}										}									?>									 </datalist>								</div>		</div></div><div id='formdv2' style='display: none'>    <div id='dynamicInputSingleTeachers'>							<div class='item form-group'>								<label class='control-label col-md-3 col-sm-3 col-xs-12' for='sub_teacher_name'>Subject Multiple Teacher Name <span class='required'>*</span>								</label>								<div class='col-md-6 col-sm-6 col-xs-12'>								  <input id='sub_teacher_name' class='form-control col-md-7 col-xs-12'  name='sub_teacher_name[]'  required='required' type='text' list='teachers' />								  <datalist id='teachers'>									<?php									$fetch_query = 'SELECT `id`,`name` FROM `teacher` WHERE 1';				if ($res = mysqli_query($dbcon,$fetch_query)) {										if (mysqli_num_rows($res) > 0) {										while ($row = mysqli_fetch_assoc($res)) {									?>									<option value='<?php echo $row['name']; ?>' >									<?php												}											}										}									?>								 </datalist>								</div>			</div>	</div>	<hr width='80%'>						<div class='item form-group' align='right'>							<div class='col-md-10 col-sm-10 col-xs-12' >							  <button class='btn btn-app' onClick='addInputmultiple('dynamicInputSingleTeachers');'>										<i class='glyphicon glyphicon-plus'><span class='docs-tooltip' data-toggle='tooltip' title='Add More'>									  </span></i>							  </button> 							</div>						  </div></div>";
				  
				  
				  document.getElementById(divName).appendChild(newdiv);
				  count++;  
			 
		}
	</script>
<script>
		var counter = 1;
		
		function addInput(divName){
			 
				  var newdiv = document.createElement('div');
				  newdiv.innerHTML =  "<hr width='80%'><div class='item form-group'>                  <label class='control-label col-md-3 col-sm-3 col-xs-12' for='sub_name'>Subject Name <span class='required'>*</span>           </label>                        <div class='col-md-6 col-sm-6 col-xs-12'>                          <input id='sub_name' class='form-control col-md-7 col-xs-12'  name='sub_name[]'  required='required' type='text' list='subjects' >							  <datalist id='subjects'>									<?php									$fetch_query = 'SELECT `id`,`sub_name` FROM `subjects` WHERE 1';									if ($res = mysqli_query($dbcon,$fetch_query)) {										if (mysqli_num_rows($res) > 0) {											while ($row = mysqli_fetch_assoc($res)) {								?>								<option value='<?php echo $row['sub_name']; ?>' >								<?php											}										}									}?>								 </datalist>     </div>                      </div>                      <div class='item form-group'>                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='sub_name'>Subject Type <span class='required'>*</span>                        </label>                        <div class='col-md-6 col-sm-6 col-xs-12'>                          <select class='form-control' name='sub_type[]'>									<option value=''>Choose option</option>									<option value='1' >Theory</option>									<option value='2' >Practical</option>		 </select>                        </div>                      </div>					    <div class='item form-group'>								<label class='control-label col-md-3 col-sm-3 col-xs-12' for='optional_sub'>Optional Subject <span class='required'>*</span>								</label>								<div class='col-md-6 col-sm-6 col-xs-12'>								  <div id='optional_sub' class='btn-group' data-toggle='buttons'>	 <input type='radio' class='flat' name='optional_sub[]' value='0'> &nbsp; No&nbsp;  <input type='radio' class='flat' name='optional_sub[]' value='1'> Yes </div></div>					</div> <div class='item form-group'>								<label class='control-label col-md-3 col-sm-3 col-xs-12' for='multiple_techers'>Multiple Teachers <span class='required'>*</span>								</label>								<div class='col-md-6 col-sm-6 col-xs-12'>									  <label for='chkNo'>										<input type='radio' id='chkNo' name='multiple_techers[]' value='1' />										No										</label>									  <label for='chkYes'>										<input type='radio' id='chkYes' name='multiple_techers[]' value='0' />										Yes										</label>																	</div>	</div>";
				  document.getElementById(divName).appendChild(newdiv);
				  counter++;  
			 
		}
	</script>
  </body>
</html>
<?php
	ob_end_flush();
?>