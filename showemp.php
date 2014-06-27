<html>
<body>
<?php
	include ("header.php");
	session_start();
	require_once ("cont/Cont_Auth.php");
	$log = new Cont_Auth();
	if(isset($_SESSION['SESS_LEVEL']) && $_SESSION['SESS_LEVEL'] == $log->adminLevel){
		$start = @trim($_GET['after']);
		$end = @trim($_GET['before']);
		$max = 3;
		
		$output = $log->showEmps($start, $end, $max);
		if(!$output){
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		echo $output;
		
	} else {
		echo "You are not the admin I am looking for!";
	}
?>
</body>
</html>