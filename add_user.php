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
	$form_names = $csrf->form_names(array('name', 'email'), false);
	if(isset($_POST[$form_names['name']], $_POST[$form_names['email']], $_POST['add_user']) && !empty($_POST[$form_names['name']]) && !empty($_POST[$form_names['email']])) {
        // Check if token id and token value are valid.
        if($csrf->check_valid('post')) {
                // Get the Form Variables.
                $name = $_POST[$form_names['name']];
                $email = $_POST[$form_names['email']];
 
                // Form Function Goes Here
                if(add_user($name,$email))
                {
                	echo "User added Successfully!!!";
                }
                else
                {
                	echo "Falied to add user";
                }
        }
        // Regenerate a new random value for the form.
        $form_names = $csrf->form_names(array('name', 'email'), true);
	}
?>
<form method="POST" action="add_user.php">
	<input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />

	<label for="name">Name: </label>
	<input id="name" type="text" name="<?= $form_names['name']; ?>"/><br/><br/>

	<label for="email">Email: </label>
	<input id="email" type="email" name="<?= $form_names['email']; ?>"/><br/><br/>

	<input type="submit" name="add_user"/><br/><br/>
</form>
<?php
	ob_end_flush();
?>