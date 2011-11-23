<html>
<body>
<?php
	require_once ("class_auth.php");
	session_start();
	$log = new auth_emp();
	$user = @trim($_POST['username']);
	$pass = @trim($_POST['password']);
	$fname = @trim($_POST['fname']); 
	$lname = @trim($_POST['lname']);
	$level = @trim($_POST['level']);
	
	if($log->register($user, $pass, $level, $fname, $lname)){
		$_SESSION['ERRMSG'] = "User Added!";
	} else {
		if(isset($_SESSION['REG_ERR'])) {
			$_SESSION['ERRMSG'] = $_SESSION['REG_ERR'];
			unset($_SESSION['REG_ERR']);
		} else {
			$_SESSION['ERRMSG'] = "An unknown error has occurred!";
		}		
	}
	session_write_close();
	header("location: empregister.php");
	exit;
?>
</body>
</html>