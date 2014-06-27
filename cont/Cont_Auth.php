<?php

class Cont_Auth {	
	var $userTable = 'candidates';
	var $empTable = 'employees';
	var $appTable = 'applications';
	var $postsTable = 'positions';
	var $workTable = 'workxp'; //WORK EXPERIENCE TABLE, NOT JOB POSITIONS TABLE
	
	var $userColumn = 'useremail';
	var $passColumn = 'password';
	var $idColumn = 'userid';
	var $userLevel = 'userlevel';
	var $active = 'active';
	var $fnameColumn = 'fname';
	var $lnameColumn = 'lname';
	
	var $empUserColumn = 'empemail';
	var $empIdColumn = 'empid';
	
	var $candLevel = "0";
	var $hrLevel = "1";
	var $hiringLevel = "2";
	var $adminLevel = "3";
	
	
	var $secret ='$2a-=<><!$cxv?&ho9as0';
	
	var $jobIdColumn = 'posid';
	var $baseJob = 1;
	
	
	function login($username, $password, $level){
		require_once('PasswordHash.php');
		require_once('Db_Connector.php');
		
		$db = new Db_Connector();
		session_start();
		$con = $db->connect();
		$pwd = new PasswordHash(8, FALSE);
		
		if($level == $this->candLevel){
			$result = $db->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->userColumn."='%s';" , $username);
			if(!$result){
				mysql_close($con);
				return false;
			}
		}
		else {
			$result = $db->qry("SELECT * FROM ".$this->empTable." WHERE ".$this->empUserColumn."='%s';" , $username);
			if(!$result){
				mysql_close($con);
				return false;
			}
		}
			
		$row=mysql_fetch_assoc($result);
		mysql_close($con);
		if($pwd->CheckPassword($password, $row[$this->passColumn])){
			//Logged in!
			if($level == $this->candLevel){
				if($row[$this->active]){
					session_regenerate_id();
					$_SESSION['SESS_MEMBER_ID'] = $row[$this->idColumn];
					$_SESSION['SESS_LEVEL'] = '0';
					return true;
				} else {
					$_SESSION['LOG_ERR'] = true;
					return false;
				}
			} else {
				session_regenerate_id();
				$_SESSION['SESS_MEMBER_ID'] = $row[$this->empIdColumn];
				$_SESSION['SESS_LEVEL'] = $row[$this->userLevel];
				return true;
			}
		} else {
			return false;
		}
		 
	}
	
	function register($username, $password, $level, $fname, $lname){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		
		$con = $db->connect();
		if($level == $this->candLevel) {
			$result = $db->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->userColumn."='%s';" , $username);
		} else {
			$result = $db->qry("SELECT * FROM ".$this->empTable." WHERE ".$this->empUserColumn."='%s';" , $username);
		}
		if(!$result) {
			$_SESSION['REG_ERR'] = 'Database Error';
			mysql_close($con);
			return false;
		}
		
		if(mysql_num_rows($result) > 0) {
			$_SESSION['REG_ERR'] = 'Email is already in the system';
			mysql_close($con);
			return false;
		}
		
		require_once('PasswordHash.php');
		
		$pwd = new PasswordHash(8, FALSE);
		
		$hash = $pwd->HashPassword($password);
		if($level == $this->candLevel) {
			$success = $db->qry("INSERT INTO ".$this->userTable." (".$this->userColumn.", ".$this->passColumn.", ".$this->fnameColumn.", ".$this->lnameColumn.") 
				VALUES ('%s', '%s', '%s', '%s')", $username, $hash, $fname, $lname);
		} else {
			$success = $db->qry("INSERT INTO ".$this->empTable." (".$this->empUserColumn.", ".$this->passColumn.", ".$this->userLevel.", ".$this->fnameColumn.", ".$this->lnameColumn.") 
				VALUES ('%s', '%s', '%s', '%s', '%s')", $username, $hash, $level, $fname, $lname);
		}
		mysql_close($con);
		if($success) {
			return true;
		} else {
			$_SESSION['REG_ERR'] = 'Database Error';
			return false;
		}
	}
	
	function sendEmail($email){
		$username = urlencode($email);
		$code = md5($email.$this->secret);
	
		echo "In lieu of an actual email, please click the following link: <br />";
		echo '<a href ="verify.php'.'?email='.$username.'&code='.$code.'">Click Me!</a>';
		return true;
		
	}
	
	function verify($email, $code){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		
		$codeA = md5($email.$this->secret);
		
		if( $code != $codeA ) {
			$_SESSION['VER_ERR'] = 'Improper Link';
			return false;
		}
		
		$email = urldecode($email);
		$con = $db->connect();
		$result = $db->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->userColumn."='%s';" , $email);
		if(!$result) {
			mysql_close($con);
			$_SESSION['VER_ERR'] = 'Database Error';
			return false;
		}
		
		if(mysql_num_rows($result) == 0) {
			mysql_close($con);
			$_SESSION['VER_ERR'] = 'No Such Account Found';
			return false;
		}
		
		$row=mysql_fetch_assoc($result);
		if($row[$this->active] == 1) {
			mysql_close($con);
			$_SESSION['VER_ERR'] = 'Account Already Verified';
			return false;
		}
		
		//Do all the stuff for a newly verified user;
		$success = $db->qry("INSERT INTO ".$this->appTable." (".$this->idColumn.", ".$this->jobIdColumn.", appDate) 
			VALUES ('%s', '%s', %s)", $row[$this->idColumn], $this->baseJob, "CURDATE()");
		if(!$success){
			mysql_close($con);
			$_SESSION['VER_ERR'] = 'Database Error';
			return false;
		}
		
		$result = $db->qry("UPDATE ".$this->userTable." SET ".$this->active." = '1' WHERE ".$this->userColumn."='%s';" , $email);
		
		mysql_close($con);
		if(!$result) {
			$_SESSION['VER_ERR'] = 'Database Error';
			return false;
		}
		
		return true;
		
	}
	
	function removeAccount($user){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		$con = $db->connect();
		
		$result = $db->qry("DELETE FROM ".$this->userTable." WHERE ".$this->userColumn."='%s';" , $user);
		mysql_close($con);
		return $result;
	}
	
	function showEmps($start, $end, $max){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		$con = $db->connect();
	
		$returnString = "";
		if($start && is_int(intval($start))) {
			$result = $db->qry("SELECT * FROM ".$this->empTable." WHERE ".$this->empIdColumn.">'%s';" , $start);
			$forward = 1;
		} else if ($end){
			$forward = 0;
			$result = $db->qry("SELECT * FROM ".$this->empTable." WHERE ".$this->empIdColumn."<='%s' ORDER BY ".$this->empIdColumn." DESC;" , $end);
		} else{
			$forward = 1;
			$result = $db->qry("SELECT * FROM ".$this->empTable.";" );
			$start = 0;
		}
		if(!$result) {
			mysql_close($con);
			return null;
		}
		$numRows = mysql_num_rows($result);
		if($numRows == 0) {
			$returnString .= "Oops! There are no results that match your query!";
		} else {
			$returnString .= "<table><tr><th>ID</th><th>Email</th><th>Account Type</th><th>First Name</th><th>Last Name</th></tr>";
			$tableData = "";
			for($i = 0; $i < $max; $i++) {
				$row = mysql_fetch_assoc($result);
				if(!$row) {
					break;
				}
				$rowData = "<tr><td>".$row['empid']."</td><td>".$row['empemail']."</td><td>";
				if($row['userlevel'] == 1) {
					$rowData .= "HR Employee";
				} else if($row['userlevel'] == 2) {
					$rowData .= "Hiring Manager";
				} else if($row['userlevel'] == 3) {
					$rowData .= "Admin";
				}
				$rowData .= "</td><td>".$row['fname']."</td><td>".$row['lname']."</td></tr>";
				if($forward) {
					$tableData .= $rowData;
				} else {
					$tableData = $rowData.$tableData;
				}
			}
			$returnString .= $tableData."</table>";
			if($forward){
				$result = $db->qry("SELECT * FROM ".$this->empTable." WHERE ".$this->empIdColumn."<'%s';" , $start);
				if(!$result) {
					mysql_close($con);
					return null;
				}
				if ( mysql_num_rows($result) != 0){
					$returnString .= '<a href="showemp.php?before='.$start.'">Prev '.$max.'</a> ';
				}
				if ($numRows > $max) {
					$returnString .= '<a href="showemp.php?after='.$row['empid'].'">Next '.$max.'</a>';
				}
			} else {
				if ($numRows > $max) {
					$newPrev = $row['empid'] - 1;
					$returnString .= '<a href="showemp.php?before='.$newPrev.'">Prev '.$max.'</a> ';
				}
				$result = $db->qry("SELECT * FROM ".$this->empTable." WHERE ".$this->empIdColumn.">'%s';" , $end);
				if(!$result) {
					mysql_close($con);
					return null;
				}
				if ( mysql_num_rows($result) != 0){
					$returnString .= '<a href="showemp.php?after='.$end.'">Next '.$max.'</a>';
				}
			}
		}
		
		mysql_close($con);
		return $returnString;
	}
}
?>