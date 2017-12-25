<table id="datatable" class="table table-striped table-bordered">
	<thead>
		<tr>
		  <th>Sr. No.</th>
		  <th>Question</th>
		  <th>Action</th>
		  
		</tr>
	</thead>


	<tbody>
		<tr>
<?php
	$fetch_query = "SELECT `id`,`question` FROM `acad_form_questions` WHERE `sub_cat_id` = '$cat_id'";
	if ($res = mysqli_query($dbcon,$fetch_query)) {
		if (mysqli_num_rows($res) > 0) {
			$count = 1;
			while ($row = mysqli_fetch_assoc($res)) {
?>
		  <td><?php echo $count++;?></td>
		  <td><?php echo $row['question'];?></td>
		  <td><input type="submit" name="delete" value="Delete" class="btn btn-danger" onclick="delete_ques('<?php echo $cat_id; ?>','<?php echo $row['id']; ?>','<?php echo $name; ?>')"/></td>
		  
		  
		</tr>

<?php
			}
		}
	}
?>
	</tbody>
</table>