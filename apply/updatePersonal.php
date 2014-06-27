<?php
	session_start();
	if(isset($_SESSION['SESS_MEMBER_ID']) && (trim($_SESSION['SESS_MEMBER_ID']) != '')) {
		require_once ("../cont/Cont_App.php");
		
		$cand = array();
		$cand['lname'] = @trim($_POST['LName']);
		$cand['fname'] = @trim($_POST['FName']);
		$cand['minit'] = @trim($_POST['MName']);
		$cand['address'] = @trim($_POST['address']);
		$cand['city'] = @trim($_POST['city']);
		$cand['state'] = @trim($_POST['state']);
		$cand['zip'] = @trim($_POST['zip']);
		$cand['phone'] = @trim($_POST['tnumber']);
		$cand['ssn'] = @trim($_POST['ssn']);
		$cand['isEighteen'] = @trim($_POST['isEighteen']);
		$cand['hasTrans'] = @trim($_POST['hasTrans']);
		
		if(strlen($cand['lname']) > 20) {
			$_SESSION['STATUS'] = 'Last Name is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($cand['fname']) > 20) {
			$_SESSION['STATUS'] = 'First Name is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($cand['minit']) > 1) {
			$_SESSION['STATUS'] = 'Middle Initial is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($cand['address']) > 60) {
			$_SESSION['STATUS'] = 'Address is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($cand['city']) > 60) {
			$_SESSION['STATUS'] = 'City is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($cand['state']) > 2) {
			$_SESSION['STATUS'] = 'State is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($cand['zip']) > 5) {
			$_SESSION['STATUS'] = 'Zip is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($cand['phone']) > 15) {
			$_SESSION['STATUS'] = 'Phone Number is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($cand['ssn']) > 4) {
			$_SESSION['STATUS'] = 'Social Security Number is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		}
		
		$app = new Cont_App();
		if(!$app->setPersonal($cand, $_SESSION['SESS_MEMBER_ID'])){
			session_write_close();
			header("location: ../dbError.php");
			exit;
		}
		
		$_SESSION['STATUS'] = 'Changes have been saved!';
		session_write_close();
		header("location: personaldata.php");
		exit;
	} else {
		session_write_close();
		header("location: ../login.php");
		exit;
	}
?>