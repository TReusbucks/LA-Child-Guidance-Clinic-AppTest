<html>
<body>
<?php
	include ("header.php");
	session_start();
	require_once ("cont/Cont_Post.php");
	$postCont = new Cont_Post();
	if(isset($_SESSION['SESS_LEVEL']) && ($_SESSION['SESS_LEVEL'] == $postCont->adminLevel || $_SESSION['SESS_LEVEL'] == $postCont->hrLevel) ){
		$start = @trim($_GET['after']);
		$end = @trim($_GET['before']);
		$max = 3;
		
		$output = $postCont->showPosts($start, $end, $max);
		
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
		echo "You are not the mushroom I am looking for! Wait...";
	}
?>
</body>
</html>