<?php
	session_start();
	if(isset($_SESSION['SESS_MEMBER_ID']) && (trim($_SESSION['SESS_MEMBER_ID']) != '')) {
		require ("class_auth.php");
		
		$lname = @trim($_POST['LName']);
		$fname = @trim($_POST['FName']);
		$minit = @trim($_POST['MName']);
		$address = @trim($_POST['address']);
		$city = @trim($_POST['city']);
		$state = @trim($_POST['state']);
		$zip = @trim($_POST['zip']);
		$phone = @trim($_POST['tnumber']);
		$ssn = @trim($_POST['ssn']);
		$isEighteen = @trim($_POST['isEighteen']);
		$hasTrans = @trim($_POST['hasTrans']);
		
		if(strlen($lname) > 20) {
			mysql_close($con);
			$_SESSION['STATUS'] = 'Last Name is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($fname) > 20) {
			mysql_close($con);
			$_SESSION['STATUS'] = 'First Name is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($minit) > 1) {
			mysql_close($con);
			$_SESSION['STATUS'] = 'Middle Initial is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($address) > 60) {
			mysql_close($con);
			$_SESSION['STATUS'] = 'Address is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($city) > 60) {
			mysql_close($con);
			$_SESSION['STATUS'] = 'City is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($state) > 2) {
			mysql_close($con);
			$_SESSION['STATUS'] = 'State is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($zip) > 5) {
			mysql_close($con);
			$_SESSION['STATUS'] = 'Zip is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($phone) > 15) {
			mysql_close($con);
			$_SESSION['STATUS'] = 'Phone Number is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		} else if (strlen($ssn) > 4) {
			mysql_close($con);
			$_SESSION['STATUS'] = 'Social Security Number is too Long';
			session_write_close();
			header("location: personaldata.php");
			exit;
		}
		
		$log = new auth_emp();
		$con = $log->connect();
		$result = $log->qry("UPDATE ".$log->userTable." SET fname='%s', lname='%s', minit='%s', address='%s', city='%s', state='%s', zip='%s', phone='%s', ssn='%s', isEighteen='%s', hasTrans='%s'
			WHERE ".$log->idColumn."='%s';" , $fname, $lname, $minit, $address, $city, $state, $zip, $phone, $ssn, $isEighteen, $hasTrans, $_SESSION['SESS_MEMBER_ID']);
		if(!$result){
			mysql_close($con);
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		mysql_close($con);
		$_SESSION['STATUS'] = 'Changes have been saved!';
		session_write_close();
		header("location: personaldata.php");
		exit;
	} else {
		session_write_close();
		header("location: login.php");
		exit;
	}
?>