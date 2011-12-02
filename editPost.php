<?php
	session_start();
	require_once ("cont/Cont_Post.php");
	$postCont = new Cont_Post();
	if(isset($_SESSION['SESS_LEVEL']) && ($_SESSION['SESS_LEVEL'] == $postCont->adminLevel || $_SESSION['SESS_LEVEL'] == $postCont->hrLevel)) {
		$post = array();
		$post['title'] = @trim($_POST['title']);
		$post['desc'] = @trim($_POST['description']);
		$post['resp'] = @trim($_POST['responsibilities']);
		$post['req'] = @trim($_POST['requirements']);
		$post['perks'] = @trim($_POST['perks']);
		$post['quests'] = @trim($_POST['quests']);
		$post['hman'] = @trim($_POST['select']);
		

		$success = $postCont->editPost($post, $_SESSION['SESS_LEVEL'], $_POST['posid']);
		if(!$success){
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		$_SESSION['ERRMSG'] = "Post Successfully Changed!";
		session_write_close();
		header("location: showposts.php");
		exit;
	} else{
		echo "Hey, what's that over there??";
	}
?>