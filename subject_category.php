<?php
	session_start();

	ob_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/csrf.class.php';
	require_once 'bin/lib/utils.php';
  require_once 'bin/lib/user_mgmt.php';
  require_once 'bin/lib/sub_cat_mgmt.php';

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
	$form_names = $csrf->form_names(array('name'), false);
	if(isset($_POST[$form_names['name']], $_POST['add_sub_cat']) && !empty($_POST[$form_names['name']])) {
        // Check if token id and token value are valid.
        if($csrf->check_valid('post')) {
                // Get the Form Variables.
                $name = $_POST[$form_names['name']];
                // Form Function Goes Here
                if(add_subject_cat($name))
                {
                  unset($_POST);
                	echo "<script> alert(Subjecy Category added Successfully!!!);window.location = '.'; </script>";

                }
                else
                {
                	echo "<script> alert(Falied to add subject category); </script>";
                }
        }
        // Regenerate a new random value for the form.
        $form_names = $csrf->form_names(array('name'), true);
	}
?>
<!DOCTYPE html>
<html lang="en">
 <?php include("theme/head.php");?>
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
                <h3>Subject Category</h3>
              </div>
            </div>
            <!-- VIEW SUBJECT CATEGORY CARD -->
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Existing Subject Category</h2>
                    
          
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="user_container">
                    
          
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          
                          <th>Action</th>
              
                        </tr>
                      </thead>


                      <tbody>
                        
            <?php
              $fetch_query = "SELECT `id`, `name` FROM `sub_category`";
              if ($res = mysqli_query($dbcon,$fetch_query)) {
                if (mysqli_num_rows($res) > 0) {
                  while ($row = mysqli_fetch_assoc($res)) {
            ?>
                        <tr>
                          <td><?php echo $row['name'];?></td>
                          
                          <td><input type="submit" name="delete" value="Delete" class="btn btn-danger" onclick="delete_sub_cat(<?php echo $row['id']; ?>)"/></td>
                          
              
                        </tr>
                        
            <?php
                  }
                }
                else
                {
            ?>
                <tr>
                  <td colspan="2"> No Subject Category Added .... </td>
                </tr>
            <?php
                }
              }
            ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
      
          </div>
            <!-- ADD SUBJECT CATEGORY FROM -->
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Subject Category</h2>
                    
					
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					
					<form method="POST" action="subject_category.php" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						<input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
						Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input id="name" type="text" name="<?= $form_names['name']; ?>" class="form-control col-md-7 col-xs-12"/>
                        </div>
                      </div>
					  
					  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						
						  <button class="btn btn-primary" type="reset" onclick="reset()">Reset</button>
                          <button type="submit" name="add_sub_cat" class="btn btn-success">Add Category</button>
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
  <script type="text/javascript">
  function delete_sub_cat($id)
  {
    
    var xhttp = new XMLHttpRequest();
    
        xhttp.onreadystatechange = function() {
      
          if (this.readyState == 4 && this.status == 200) {
        
            document.getElementById('user_container').innerHTML = this.responseText; 
            eval(document.getElementById('user_container').innerHTML);
          }
        };
        xhttp.open("POST", "delete_sub_cat.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("del_id="+$id);
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
   
  </body>
</html>
<?php
	ob_end_flush();
?>