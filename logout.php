<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	$_SESSION['ERRMSG'] = 'You have successfully logged out.';
	
	header("location: login.php");
?>