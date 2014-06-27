<?php
	session_start();
	
	if(isset($_SESSION['SESS_MEMBER_ID']) && (trim($_SESSION['SESS_MEMBER_ID']) != '')) {
		require_once ("../cont/Cont_App.php");
		$app = new Cont_App();
	
		$numWork = $_POST['numWork']
		for($i = 1; $i <= $numWork; $i++) {
			$_SESSION['wname'] = @trim($_POST['wname'.$i]);
			$_SESSION['addr'] = @trim($_POST['waddress'.$i]);
			$_SESSION['phone'] = @trim($_POST['wphone'.$i]);
			$_SESSION['super'] = @trim($_POST['wsupervisor'.$i]);
			$_SESSION['reason'] = @trim($_POST['wreason'.$i]);
			$_SESSION['startDate'] = @trim($_POST['wfrom'.$i]);
			$_SESSION['endDate'] = @trim($_POST['wto'.$i]);
			$_SESSION['startSal'] = @trim($_POST['wstarting'.$i]);
			$_SESSION['endSal'] = @trim($_POST['wfinal'.$i]);
			$_SESSION['title'] = @trim($_POST['wjobtitle'.$i]);
			$_SESSION['workPerf'] = @trim($_POST['wworkperf'.$i]);
		}
		
		$app->addApp($_SESSION['SESS_MEMBER_ID'], $_SESSION['posid']);
		
		$workXp = array();
		for($i = 1; $i <= $numWork; $i++){
			$workXp[$i] = array();
			$workXp[$i]['wname'] = $_SESSION['wname'];
			$workXp[$i]['addr'] = $_SESSION['addr'];
			$workXp[$i]['phone'] = $_SESSION['phone'];
			$workXp[$i]['super'] = $_SESSION['super'];
			$workXp[$i]['reason'] = $_SESSION['reason'];
			$workXp[$i]['startDate'] = $_SESSION['startDate'];
			$workXp[$i]['endDate'] = $_SESSION['endDate'];
			$workXp[$i]['startSal'] = $_SESSION['startSal'];
			$workXp[$i]['endSal'] = $_SESSION['endSal'];
			$workXp[$i]['title'] = $_SESSION['title'];
			$workXp[$i]['workPerf'] = $_SESSION['workPerf'];
		}
		
		if(!$app->setWork($_SESSION['SESS_MEMBER_ID'], $_SESSION['posid'], $numWork, $workXp)) {
			session_write_close();
			header("location: ../dbError.php");
			exit;
		}
		
		if($_POST['save'] == 1){
			if(!$app->setWork($_SESSION['SESS_MEMBER_ID'], $app->baseJob, $numWork, $workXp)){
				session_write_close();
				header("location: ../dbError.php");
				exit;
			}
		}
		
		header("location: ../index.php");
		$_SESSION['STATUS'] = "Application Successful!";
		session_write_close();
		exit;

	} else {
		session_write_close();
		header("location: ../login.php");
		exit;
	}
?>