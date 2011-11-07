<?php
	require_once ("class_auth.php");
	session_start();
	$log = new auth_emp();
	$user = @trim($_POST['username']);
	$pass = @trim($_POST['password']);
	$fname = @trim($_POST['fname']); 
	$lname = @trim($_POST['lname']);

	if($log->register($user, $pass, "0", $fname, $lname)){
		$log->sendEmail($user);
		session_write_close();
		exit;
		/*
		if($log->sendEmail($user,$fname,$lname)) {
			session_write_close();
			header("location: sentEmail.php");
			exit;
		}  else {
			$log->removeAccount($user);
			$_SESSION['ERRMSG'] = "EMAIL SENDING ERROR";
			session_write_close();
			header("location: register.php");
			exit;
		}
		*/
	} else {
		$_SESSION['ERRMSG'] = "REGISTER ERROR";
		session_write_close();
		header("location: register.php");
		exit;
	}
	
?>