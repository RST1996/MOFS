<?php
?>

<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Action</th>
						  
                        </tr>
                      </thead>


                      <tbody>
                        <tr>
						<?php
							$fetch_query = "SELECT `id`, `name`, `email`, `password`, `admin_role` FROM `users` WHERE `admin_role` <> 1 ";
							if ($res = mysqli_query($dbcon,$fetch_query)) {
								if (mysqli_num_rows($res) > 0) {
									while ($row = mysqli_fetch_assoc($res)) {
						?>
                          <td><?php echo $row['name'];?></td>
                          <td><?php echo $row['email'];?></td>
                          <td><input type="submit" name="delete" value="Delete" class="btn btn-danger" onclick="delete_user(<?php echo $row['id']; ?>)"/></td>
                          
						  
                        </tr>
                        
						<?php
									}
								}
							}
						?>
                      </tbody>
                    </table>
                  