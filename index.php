<?php
	
	session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['username'])) {
        header('Location: template/landing.php');
        exit();
    }else{
    	header('Location: template/blog.php');
    }

?>