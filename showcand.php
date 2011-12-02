<html>
<body>
<?php
	include ("header.php");
	session_start();
	require_once ("cont/Cont_App.php");
	$app = new Cont_App();
	if(isset($_SESSION['SESS_LEVEL']) && ($_SESSION['SESS_LEVEL'] == $app->adminLevel || $_SESSION['SESS_LEVEL'] == $app->hrLevel) ){
		$posid = @trim($_GET['id']);
		$start = @trim($_GET['after']);
		$end = @trim($_GET['before']);
		$max = 3;
		
		$output = $app->showCand($posid, $start, $end, $max);
		if(!$output){
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		echo $output;
		
		if(isset($_SESSION['ERRMSG'])){
			echo $_SESSION['ERRMSG'];
			unset($_SESSION['ERRMSG']);
		}

	} else {
		echo "You are not the admin I am looking for!";
	}
?>
</body>
</html>