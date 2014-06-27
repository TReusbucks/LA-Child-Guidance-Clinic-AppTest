<?php
	session_start();
	
	if(isset($_SESSION['SESS_MEMBER_ID']) && (trim($_SESSION['SESS_MEMBER_ID']) != '')) {
		require_once ("cont/Cont_App.php");

		$app = new Cont_App();
		
		$workXp = array();
		for($i = 1; $i <= $_POST['numWork']; $i++){
			$workXp[$i] = array();
			$workXp[$i]['wname'] = @trim($_POST['wname'.$i]);
			$workXp[$i]['addr'] = @trim($_POST['waddress'.$i]);
			$workXp[$i]['phone'] = @trim($_POST['wphone'.$i]);
			$workXp[$i]['super'] = @trim($_POST['wsupervisor'.$i]);
			$workXp[$i]['reason'] = @trim($_POST['wreason'.$i]);
			$workXp[$i]['startDate'] = @trim($_POST['wfrom'.$i]);
			$workXp[$i]['endDate'] = @trim($_POST['wto'.$i]);
			$workXp[$i]['startSal'] = @trim($_POST['wstarting'.$i]);
			$workXp[$i]['endSal'] = @trim($_POST['wfinal'.$i]);
			$workXp[$i]['title'] = @trim($_POST['wjobtitle'.$i]);
			$workXp[$i]['workPerf'] = @trim($_POST['wworkperf'.$i]);
		}
		
		if(!$app->setWork($_SESSION['SESS_MEMBER_ID'],$app->baseJob, $_POST['numWork'], $workXp)){
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		$_SESSION['STATUS'] = 'Changes have been saved!';
		session_write_close();
		header("location: workexperience.php");
		exit;

	} else {
		session_write_close();
		header("location: login.php");
		exit;
	}
?>