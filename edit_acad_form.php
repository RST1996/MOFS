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
                    <h2>Form Details</h2>				
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content">
                    <br />
					  <span class="section">Subject and Teachers Details</span>
					 
					  <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Subject Name</th>
                          <th>Subject Type</th>
                          <th>Teacher Name</th>
                          <th>Optional Subject</th>
                          <th>Multiple teachers</th>
                          
                        </tr>
                      </thead>


                      <tbody>
                        <tr>
						<?php
							$select ="SELECT `subjects`.`sub_name`, `sub_category`.`name` as `sub_cat`,`subjects`.`optional_flag`,`subjects`.`multiple_teachers`,`teacher`.`name` FROM `subjects`,`assigned_teachers`,`teacher`,`sub_category` WHERE `form_id` = '$form_id' AND `assigned_teachers`.`sub_id` = `subjects`.`id`  AND `assigned_teachers`.`teacher_id` = `teacher`.`id` AND `subjects`.`sub_type` = `sub_category`.`id` ORDER BY `subjects`.`id`";
							if ($res = mysqli_query($dbcon,$select)) {
								if (mysqli_num_rows($res) > 0) {
									while ($row = mysqli_fetch_assoc($res)) {
							?>
							  <td><?php echo $row['sub_name'];?></td>
							  <td><?php echo $row['sub_cat'];?></td>
							  <td><?php echo $row['name'];?></td>
							  <td><?php if($row['optional_flag'] == 0)echo 'NO';
							  else echo 'YES';?></td>
							  <td><?php  if($row['multiple_teachers'] == 0)echo 'NO';
							  else echo 'YES';?></td>
							 
							</tr>
							
						<?php
									}
								}
							}
						?>
                      </tbody>
                    </table>
				  </div>
                  <div class="x_content">
                    <br />
					<form id="sub" class="form-horizontal form-label-left" novalidate>
					  <span class="section">Add New Subject and Teachers Details</span>
					  <div id="dynamicInput"></div>
						<hr width='80%'>
						<div class="item form-group" align="right">
							<div class="col-md-10 col-sm-10 col-xs-12" >
							  <input type="button" class="btn btn-app" onclick="addInput('dynamicInput');" value="Add Subject" /> 
							</div>
						</div>					  
                     	<div class="ln_solid"></div>
                      	<!-- 
						<div class="form-group">
                        	<div class="col-md-6 col-md-offset-3">
								<input type="submit" class="btn btn-primary" name="cancel" value="Cancel" />
								<input type="submit" class="btn btn-success" name="submit" value="Submit"> 
								<input type="submit" class="btn btn-primary" name="reset" value="Reset"  onclick="reset();" />
                        	</div>
                      	</div> 
						-->
                    </form>
                    <div id="test"></div>
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
	function visible()
	{
		$("#teachers_div").show();
       $("#addTeacherIpBtn").show();
	}
    // $(function () {
    //     $("input[name='multiple_techers[]']").click(function () {
            
    //     });
    // });
</script>
<script type="text/javascript">
	function addTeacherIp()
	{
		
		var teacherContainer = document.getElementById("teachers_div");
		//alert("hey...");
		var newTeacherIp = document.createElement('div');
		newTeacherIp.className = "item form-group";
		newTeacherIp.innerHTML = '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_teacher_name">Subject Teacher Name <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input id="sub_teacher_name" class="form-control col-md-7 col-xs-12"  name="sub_teacher_name[]"  required="required" type="text" list="teachers" /><datalist id="teachers"><?php
	$fetch_query = "SELECT `id`,`name` FROM `teacher` WHERE 1";
	if ($res = mysqli_query($dbcon,$fetch_query)) {
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($res)) {
?><option value="<?php echo $row['name']; ?>" ><?php
			}
		}
	}
?></datalist></div><span class="glyphicon glyphicon-trash" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" aria-hidden="true" ></span>';
		teacherContainer.appendChild(newTeacherIp);
	}
</script>
<script>	
	function addInput(divName)
	{		 
		
		var container = document.getElementById(divName);
		
		if(container.innerHTML=='')
		{
			//alert("Hello");
			//Here process the form && submit via ajax..
			//Then clear the div again
			refresh_form(divName);
		}
		else
		{
			var string = $('form#sub').serialize();
			var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
				
	        	if (this.readyState == 4 && this.status == 200) {
					
	        		//document.getElementById('test').innerHTML = this.responseText; 
					var return_val = this.responseText;
					if(return_val == "task completed sucessfully")
					{
						container.innerHTML = "";
						refresh_form(divName);
						location.reload();
					}
					else if(return_val == "teacher not found")
					{
						alert("Teacher entries not found .. plz select only from the suggestion..");
						return ;
					}
					else if(return_val == "failed.... contact ADMIN")
					{
						alert("Failed.. CONTACT ADMIN");
					}
	        	}
	        };
	        xhttp.open("POST", "ajax_test.php?form_id=<?php echo $form_id;?>", true);
	        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        xhttp.send(string);
			
		}		
	}

		function validTeacher(teacherElement)
		{
			// var teacherName = teacherElement.value;
			// var teacherAvailable = []
		}
		
		function refresh_form(divName)
		{
			var container = document.getElementById(divName);
			var sName = document.createElement('div');
			
			sName.className = "item form-group";
			sName.innerHTML = '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_name"  >Subject Name <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-8"><input id="sub_name" class="form-control col-md-7 col-xs-12"  name="sub_name"  required="required" type="text"></div>';
			container.appendChild(sName);

			var sCat = document.createElement('div');
			sCat.className = "item form-group";
			sCat.innerHTML = '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_name">Subject Type <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><select class="form-control" name="sub_type" required="required" class="form-control col-md-7 col-xs-12" ><option value=""> --SELECT A SUBJECT CATEGORY--</option><?php
			$sub_cat_fetch_query = "SELECT * FROM `sub_category`";
			if($res = mysqli_query($dbcon,$sub_cat_fetch_query))
			{
				while($row = mysqli_fetch_assoc($res))
				{
					$value = $row['id'];
					$sub_cat = $row['name'];
		?><option value="<?php echo $value; ?>"><?php echo $sub_cat; ?></option><?php
				}
			}
		?></select></div>';
			container.appendChild(sCat);

			var oflag = document.createElement('div');
			oflag.className = "item form-group";
			oflag.innerHTML = '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="optional_sub">Optional Subject <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="checkbox"  name="optional_sub" value="0"> &nbsp; No&nbsp;<input type="checkbox"  name="optional_sub" value="1"> Yes</div>';
			container.appendChild(oflag);

			var mulflag = document.createElement('div');
			mulflag.className = "item form-group";
			mulflag.innerHTML = '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="multiple_techers">Multiple Teachers <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="checkbox" id="chkNo" name="multiple_techers" onclick="visible();" value="0" /><label for="chkNo">&nbsp; No&nbsp;</label><input type="checkbox" id="chkYes" name="multiple_techers" onclick="visible();" value="1" /><label for="chkYes">Yes</label></div>';
			container.appendChild(mulflag);

			var teachersdiv = document.createElement('div');
			teachersdiv.setAttribute("id", "teachers_div");
			teachersdiv.style.display='none';
			var teacherIp = document.createElement('div');
			teacherIp.className = "item form-group";
			teacherIp.innerHTML = '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_teacher_name">Subject Teacher Name <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input id="sub_teacher_name" class="form-control col-md-7 col-xs-12"  name="sub_teacher_name[]"  required="required" type="text" oninput="validTeacher(this);" list="teachers" /><datalist id="teachers"><?php
		$fetch_query = "SELECT `id`,`name` FROM `teacher` WHERE 1";
		if ($res = mysqli_query($dbcon,$fetch_query)) {
			if (mysqli_num_rows($res) > 0) {
				while ($row = mysqli_fetch_assoc($res)) {
	?><option value="<?php echo $row['name']; ?>" ><?php
				}
			}
		}
	?></datalist></div>';
			teachersdiv.appendChild(teacherIp);
			container.appendChild(teachersdiv);

			container.innerHTML += '<div class="item form-group" id="addTeacherIpBtn" style="display:none;" align="right"><div class="col-md-10 col-sm-10 col-xs-12" ><input type="button" class="btn btn-app" value="Add Teacher" onclick="addTeacherIp();" /></div></div>';

			
		}
</script>

</body>
</html>
<?php
	ob_end_flush();
?>