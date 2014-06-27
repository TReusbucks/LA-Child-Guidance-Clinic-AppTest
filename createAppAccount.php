<?php
	require_once ("cont/Cont_Auth.php");
	session_start();
	$log = new Cont_Auth();
	$user = @trim($_POST['username']);
	$pass = @trim($_POST['password']);
	$fname = @trim($_POST['fname']); 
	$lname = @trim($_POST['lname']);

	if($log->register($user, $pass, $log->candLevel, $fname, $lname)){
		$log->sendEmail($user);
		session_write_close();
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
		if(isset($_SESSION['REG_ERR'])) {
			$_SESSION['ERRMSG'] = $_SESSION['REG_ERR'];
			unset($_SESSION['REG_ERR']);
		} else {
			$_SESSION['ERRMSG'] = "An unknown error has occurred!";
		}
		session_write_close();
		header("location: register.php");
		exit;
	}
	
?>