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

	if(isset($_POST['name'], $_POST['sub_type'],  $_POST['add_user'],$_POST['optional_sub'],$_POST['multiple_techers']) ) {
       
                $name = $_POST['name'];
                $sub_type = $_POST['sub_type'];
				$optional = $_POST['optional_sub'];
				$multiple = $_POST['multiple_techers'];
               $insert_form = "INSERT INTO `subjects`(`id`, `sub_name`, `sub_type`, `optional_flag`, `multiple_teachers`, `form_id`) VALUES(NULL,'$name','$sub_type','$optional','$multiple','0')";
				if ($res = mysqli_query($dbcon,$insert_form) ){
					
					echo "<script> alert('Subject added Successfully!!!'); </script>";
				}
				else
				{
					echo "<script> alert('Falied to add subject'); </script>";
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
					
					<form method="POST" action="add_subject.php" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
						Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input id="name" type="text" name="name" class="form-control col-md-7 col-xs-12"/>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_type">
						Subject Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control" name="sub_type" required="required" class="form-control col-md-7 col-xs-12" >
									 <option></option>
									<option value="1">Theory</option>
									<option value="2">Practical</option>
						  </select>
                        </div>
                      </div>
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="op_sub">
						optional Subject <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<input type="radio"  name="optional_sub" value="0"> &nbsp; No&nbsp;
							<input type="radio"  name="optional_sub" value="1"> Yes
                        </div>
                      </div>
					  <div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="multiple_techers">Multiple Teachers <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									  
										<input type="radio" name="multiple_techers" value="0" />
										No
										
										<input type="radio" name="multiple_techers" value="1" />
										Yes
										
								</div>
								
							</div>
						  <div class="ln_solid"></div>
						  <div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							
							  <button class="btn btn-primary" type="reset" onclick="reset()">Reset</button>
							  <input type="submit" class="btn btn-success" name="add_user" value="Add Subject"> 
							
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