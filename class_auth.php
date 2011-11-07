<?php

class auth_emp {
	var $hostname ='localhost:3306';
	var $database ='lacgc';
	var $dbUsername ='root';
	var $dbPassword ='';
	
	var $address = 'localhost/lacgc/verify.php';
	
	var $userTable = 'employee_login';
	var $userColumn = 'useremail';
	var $passColumn = 'password';
	var $idColumn = 'userid';
	var $userLevel = 'userlevel';
	var $active = 'active';
	var $fnameColumn = 'fname';
	var $lnameColumn = 'lname';
	
	var $secret ='$2a-=<><!$cxv?&ho9as0';
	
	function connect(){
		$con = mysql_connect($this->hostname, $this->dbUsername, $this->dbPassword);
		if(!$con){
			die('Problem connecting to database:' . mysql_error());
		}
		mysql_select_db($this->database, $con) or die('Problem selecting database:' . mysql_error());
		return $con;
	}
	
	//This function ensures that there are no injection shenanigans
	//Assumes already connected;
	function qry(){
		$args = func_get_args();
		$query = array_shift($args);
		$args = array_map('mysql_real_escape_string', $args);
		array_unshift($args, $query);
		$query = call_user_func_array('sprintf',$args);
		$result = mysql_query($query) or die(mysql_error());
		return $result;
	}
	
	function login($username, $password){
		require('PasswordHash.php');
		session_start();
		$con = $this->connect();
		$pwd = new PasswordHash(8, FALSE);
		
		$result = $this->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->userColumn."='%s';" , $username);
		if(!$result){
			mysql_close($con);
			return false;
		}
		
		$row=mysql_fetch_assoc($result);
		mysql_close($con);
		if($pwd->CheckPassword($password, $row[$this->passColumn])){
			//Logged in!
			if($row[$this->active]){
				session_regenerate_id();
				$_SESSION['SESS_MEMBER_ID'] = $row[$this->idColumn];
				$_SESSION['SESS_LEVEL'] = $row[$this->userLevel];
				return true;
			} else {
				$_SESSION['LOG_ERR'] = true;
				return false;
			}
		} else {
			return false;
		}
	}
	
	function register($username, $password, $level, $fname, $lname){
		$con = $this->connect();
		$result = $this->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->userColumn."='%s';" , $username);
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
		
		require('PasswordHash.php');
		
		$pwd = new PasswordHash(8, FALSE);
		
		$hash = $pwd->HashPassword($password);
		$success = $this->qry("INSERT INTO ".$this->userTable." (".$this->userColumn.", ".$this->passColumn.", ".$this->userLevel.", ".$this->fnameColumn.", ".$this->lnameColumn.") 
			VALUES ('%s', '%s', '%s', '%s', '%s')", $username, $hash, $level, $fname, $lname);
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
	
		/*
		$subject = 'LACGC Verification';
		$message = '
		Thanks for signing up for an LACGC account!
		To activate your account, please click the following link:
		
		'.$this->address.'?email='.$username.'code='.$code.'
		
		';
		*/
		echo $this->address.'?email='.$username.'&code='.$code;
		return true;
		
	}
	
	function verify($email, $code){
		$codeA = md5($email.$this->secret);
		
		if( $code != $codeA ) {
			$_SESSION['VER_ERR'] = 'Improper Link';
			return false;
		}
		
		$email = urldecode($email);
		$con = $this->connect();
		$result = $this->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->userColumn."='%s';" , $email);
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
		
		$result = $this->qry("UPDATE ".$this->userTable." SET ".$this->active." = '1' WHERE ".$this->userColumn."='%s';" , $email);
		mysql_close($con);
		if($result) {
			return true;
		} else {
			$_SESSION['VER_ERR'] = 'Database Error';
			return false;
		}

	}
	
	function removeAccount($user){
		$con = $this->connect();
		$result = $this->qry("DELETE FROM ".$this->userTable." WHERE ".$this->userColumn."='%s';" , $user);
		mysql_close($con);
		return $result;
	}
}
?>