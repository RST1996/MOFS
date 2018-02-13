<?php
	session_start();
	require_once 'bin/config/dbcon.php';
	require_once 'bin/lib/utils.php';
    require_once 'bin/lib/user_mgmt.php';
    require_once 'bin/lib/sub_cat_mgmt.php';
	if (isset($_POST['del_id']) && ( isLoggedin() != null) ) {
		$del_id = $_POST['del_id'];
		
		$del_query = "DELETE FROM `sub_category` WHERE `id` = '$del_id'";
		if ($del_r = mysqli_query($dbcon,$del_query)) {
			$msg = "Delete action successfully performed!";
			
		} else {
			$msg = "Failed to delete ".mysqli_error($dbcon);
		}
		
		
?>
	<script type="text/javascript">
		alert("<?php echo $msg; ?>");
	</script>
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
<?php
	}
?>
