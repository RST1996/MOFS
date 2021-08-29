<?php
	session_start();
	require_once '../config/dbcon.php';
	require_once '../lib/utils.php';
    require_once '../lib/user_mgmt.php';
    if(!$_SESSION['current_user']['admin_role'])
	{
	    die('Un-ethical activity detected..!!  Do not try to such things here.'); 
	}
	if (isset($_POST['c_id']) && isset($_POST['id']) && ( isLoggedin() != null) ) {
		$cat_id = $_POST['c_id'];
		$del_id = $_POST['id'];
		
		$del_query = "DELETE FROM `acad_form_questions` WHERE `id` = '$del_id'";
		if ($del_r = mysqli_query($dbcon,$del_query)) {
			$msg = "Delete action successfully performed!";
			
		} else {
			$msg = "Failed to delete ".mysqli_error($dbcon);
		}
		
		
?>
	<script type="text/javascript">
		alert("<?php echo $msg; ?>");
	</script>
<?php
		require_once "../config/includes/load_acad_questions.inc.php";
		
	}
?>
