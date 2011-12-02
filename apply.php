<?php
	$posid = @trim($_GET['posid']);
	
	session_start();
	if($posid != 1) {
		$_SESSION['posid'] = $posid;
		session_write_close();
		header("location: ./apply/personaldata.php");
	} else {
		session_write_close();
		header("location: index.php");
	}
	exit;
?>