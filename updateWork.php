<?php
	session_start();
	
	if(isset($_SESSION['SESS_MEMBER_ID']) && (trim($_SESSION['SESS_MEMBER_ID']) != '')) {
		require ("class_auth.php");
		
		
		$log = new auth_emp();
		$con = $log->connect();
		
		$result = $log->qry("SELECT * FROM ".$log->workTable." WHERE ".$log->idColumn."='%s' AND ".$log->jobIdColumn."='0';" , $_SESSION['SESS_MEMBER_ID']);
		if(!$result) {
			mysql_close($con);
			$_SESSION['VER_ERR'] = 'Database Error';
			return false;
		}
		
		$numRows = mysql_num_rows($result);
		
		$dbIndex = 1;
		for($i = 1; $i <= $_POST['numWork']; $i++){
			$wname = @trim($_POST['wname'.$i]);
			$addr = @trim($_POST['waddress'.$i]);
			$phone = @trim($_POST['wphone'.$i]);
			$super = @trim($_POST['wsupervisor'.$i]);
			$reason = @trim($_POST['wreason'.$i]);
			$startDate = @trim($_POST['wfrom'.$i]);
			$endDate = @trim($_POST['wto'.$i]);
			$startSal = @trim($_POST['wstarting'.$i]);
			$endSal = @trim($_POST['wfinal'.$i]);
			$title = @trim($_POST['wjobtitle'.$i]);
			$workPerf = @trim($_POST['wworkperf'.$i]);
			
			if($wname != '') {
				if($dbIndex > $numRows) {
					$success = $log->qry("INSERT INTO ".$log->workTable." (".$log->idColumn.", ".$log->jobIdColumn.", workid , empname, address, phone, supervisor, reason, startDate, endDate, startWage, endWage, title, workPerformed) 
						VALUES ('%s', '1', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $_SESSION['SESS_MEMBER_ID'], $dbIndex, $wname, $addr, $phone, $super, $reason, $startDate, $endDate, $startSal, $endSal, $title, $workPerf);
					if(!$result){
						mysql_close($con);
						session_write_close();
						header("location: dbError.php");
						exit;
					}
					
				} else {
					$result = $log->qry("UPDATE ".$log->workTable." SET empname='%s', address='%s', phone='%s', supervisor='%s', reason='%s', startDate='%s', endDate='%s', startWage='%s', endWage='%s', title='%s', workPerformed='%s'
						WHERE ".$log->idColumn."='%s' AND ".$log->jobIdColumn."='0' AND workid='".$dbIndex."';" , $wname, $addr, $phone, $super, $reason, $startDate, $endDate, $startSal, $endSal, $title, $workPerf, $_SESSION['SESS_MEMBER_ID']);
					if(!$result){
						mysql_close($con);
						session_write_close();
						header("location: dbError.php");
						exit;
					}
				}
				$dbIndex++;
			}
		}
		
		mysql_close($con);
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