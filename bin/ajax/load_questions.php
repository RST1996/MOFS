<?php
	session_start();
	require_once '../config/dbcon.php';
	require_once '../lib/utils.php';
    require_once '../lib/user_mgmt.php';

    if (isset($_POST['id']) && isset($_POST['name']) && ( isLoggedin() != null)  && ($_SESSION['current_user']['admin_role']))
    {
    	$cat_id = $_POST['id'];
    	$name = $_POST['name'];

    	require_once	"../config/includes/load_acad_questions.inc.php";
    }
?>