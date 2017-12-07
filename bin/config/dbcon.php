<?php
	$dbcon = @mysqli_connect('localhost','root','','mofs');
	if ( mysqli_connect_errno() ) {
        //printf("Connection failed: %s", mysqli_connect_error());
        die("Failed to connect at the moment :( ..<br/> contact admin in case of urgency to report this incident ");
    }
?>