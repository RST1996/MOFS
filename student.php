<?php
    session_start();
    ob_start();
    require 'bin/config/dbcon.php';
    require 'bin/lib/utils.php';
    require 'bin/lib/user_mgmt.php'; 
    if(isLoggedin())
    {
       header('Location:index.php'); 
       die('Un-ethical activity detected..!!  Do not try to such things here.');
    }
    if(isset($_POST['log_in']))
    {
        //print_r($_POST);
        $username = mysqli_real_escape_string($dbcon,(htmlentities($_POST['username'])));
        $password = mysqli_real_escape_string($dbcon,(htmlentities($_POST['password'])));
        $msg = login($username,$password);
        if($msg == true)
        {
            header('Location:index.php');
            die('Un-ethical activity detected..!!  Do not try to such things here.');
        }
        else
        {
            ?><script>alert( 'Invalid Credentials' );</script><?php
            unset($_POST);
        }
    }

    mysqli_close($dbcon);
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <link rel="icon" href="gcoej_logo.ico" type="image/x-icon">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MOFS | Login to continue...</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="login.php">
              <h1>Login Form</h1>
              <p>Please Login to Continue...</p>
              

                <div>
                  <h1><i class="fa fa-graduation-cap "></i> GCOEJ - MOFS</h1>
                  <p>©2017 All Rights Reserved.<br/> GCOEJ - Multipurpose Online Feedback System<br/> Made with <i class="fa fa-heart "></i> by SDC</p>
				  <!--<h4><a href="developers.php"><i class="fa fa-edit "></i> Developers</a></h4> -->
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
