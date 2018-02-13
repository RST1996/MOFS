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
 
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
                <h3>Manage Academic Form Questions</h3>
              </div>

              
			  
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <!-- <div class="x_title">
                    <h2>Registered Users details</h2>
                    
					
                    <div class="clearfix"></div>
                  </div> -->
                  <div class="x_content" id="user_container">
                    
					<div class="container">
  <h2></h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Add New Questions</a></li>
<?php
	$sub_cat_fetch_query = "SELECT * FROM `sub_category`";
	if($res = mysqli_query($dbcon,$sub_cat_fetch_query))
	{
		$cat_info = Array();
		while($row = mysqli_fetch_assoc($res))
		{
			$cat_info[] = $row;
?>
			<li><a data-toggle="tab" onclick="load_questions('<?php echo $row['id'] ?>','<?php echo $row['name'] ?>')" href="#<?php echo $row['id'].$row['name']; ?>"><?php echo $row['name']; ?></a></li>
<?php
		}
	}	
?>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h2>Enter question and subject category to add new question.</h2>
      <form method="POST" action="manage_acad_questions.php" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
		<input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />

      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_cat">
		Subject Category <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
		<select id="subject_cat" type="text" name="<?= $form_names['sub_id']; ?>" class="form-control col-md-7 col-xs-12" required>
			<option value=""> --SELECT A SUBJECT CATEGORY--</option>
<?php
	foreach ($cat_info as $category) 
	{	
?>
			<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
<?php
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
<?php
	foreach ($cat_info as $category) 
	{	
?>
	<div id="<?php echo $category['id'].$category['name']; ?>" class="tab-pane fade">
      <h3><?php echo $category['name']; ?></h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
<?php
	}	
?>
    <!-- <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>

    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div> -->

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
    </div>
    </div>
			<?php include("theme/script.php");?>
	<script type="text/javascript">
	function delete_ques(c_id,id,name)
	{
		
		var xhttp = new XMLHttpRequest();
		
        xhttp.onreadystatechange = function() {
			
        	if (this.readyState == 4 && this.status == 200) {
				
        		document.getElementById(c_id+name).innerHTML = this.responseText; 
        	}
        };
        xhttp.open("POST", "bin/ajax/delete_acad_ques.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("c_id="+c_id+"&id="+id);
	}
</script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script type="text/javascript">
    	function load_questions(id,name)
    	{
    		var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
				
	        	if (this.readyState == 4 && this.status == 200) {
					
	        		document.getElementById(id+name).innerHTML = this.responseText; 
	        	}
	        };
	        xhttp.open("POST", "bin/ajax/load_questions.php", true);
	        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        xhttp.send("id="+id+"&name="+name);
    	}
    </script>
			
  </body>
</html>

<?php
    ob_end_flush();
?>