<?php
	require_once ("class_auth.php");
	session_start();
	$log = new auth_emp();
	$email = $_GET['email'];
	$code = $_GET['code'];
	if($log->verify($email, $code)){
		echo "Account Successfully Verified!";
	} else {
		echo $_SESSION['VER_ERR'];
	}
	echo '<br/><a href="index.php">Home Page</a>'
?>