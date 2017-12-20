<?php
	session_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
	if (isset($_POST['del_id']) && ( isLoggedin() != null) ) {
		$del_id = $_POST['del_id'];
		
		$del_query = "DELETE FROM `users` WHERE `id` = '$del_id'";
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
		require_once "bin/config/includes/view_user.inc.php";
		
	}
?>
