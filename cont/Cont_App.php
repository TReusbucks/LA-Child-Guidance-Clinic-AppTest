<?php

class Cont_App{
	var $userTable = 'candidates';
	var $workTable = 'workxp';
	var $appTable = 'applications';
	
	var $userLevel = 'userlevel';
	var $candLevel = "0";
	var $hrLevel = "1";
	var $hiringLevel = "2";
	var $adminLevel = "3";
	
	var $idColumn = 'userid';
	var $jobIdColumn = 'posid';
	var $baseJob = 1;

	function getPersonal($id){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		
		$con = $db->connect();
		$result  = $db->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->idColumn."='%s';" , $id);
		if(!$result) {
			mysql_close($con);
			return false;
		}
		$user=mysql_fetch_assoc($result);
		mysql_close($con);
		return $user;
	}
	
	function setPersonal($cand, $id){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		
		$con = $db->connect();
		$result = $db->qry("UPDATE ".$this->userTable." SET fname='%s', lname='%s', minit='%s', address='%s', city='%s', state='%s',".
			" zip='%s', phone='%s', ssn='%s', isEighteen='%s', hasTrans='%s' WHERE ".$this->idColumn."='%s';" , 
			$cand['fname'], $cand['lname'], $cand['minit'], $cand['address'], $cand['city'], $cand['state'], $cand['zip'], 
			$cand['phone'], $cand['ssn'], $cand['isEighteen'], $cand['hasTrans'], $id);
		mysql_close($con);
		return $result;
	}
	
	//Returns the User Profile's Work Experience
	function getWork($id, $jobId){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		
		$con = $db->connect();
		$result  = $db->qry("SELECT * FROM ".$this->workTable." WHERE ".$this->idColumn."='%s' AND ".$this->jobIdColumn."='%s';" , $id, $jobId);
		if(!$result) {
			mysql_close($con);
			return false;
		}
		
		$work = array();
		if (mysql_num_rows($result) != 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$work[] = $row;
			}
		}
		
		mysql_free_result($result);
		mysql_close($con);
		return $work;
	}
	
	function setWork($id, $jobId, $numWork, $workXp){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
	
		$con = $db->connect();
		
		$result = $db->qry("SELECT * FROM ".$this->workTable." WHERE ".$this->idColumn."='%s' AND ".$this->jobIdColumn."='%s';" , $id, $jobId);
		if(!$result) {
			mysql_close($con);
			return false;
		}
		
		$numRows = mysql_num_rows($result);

		$dbIndex = 1;
		for($i = 1; $i <= $numWork; $i++){			
			if($dbIndex > $numRows) {
				$success = $db->qry("INSERT INTO ".$this->workTable." (".$this->idColumn.", ".$this->jobIdColumn.", workid , empname, address, phone,".
					"supervisor, reason, startDate, endDate, startWage, endWage, title, workPerformed)".
					"VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
					$id, $jobId, $dbIndex, $workXp[$i]['wname'], $workXp[$i]['addr'], $workXp[$i]['phone'], $workXp[$i]['super'], $workXp[$i]['reason'], 
					$workXp[$i]['startDate'], $workXp[$i]['endDate'], $workXp[$i]['startSal'], $workXp[$i]['endSal'], $workXp[$i]['title'], 
					$workXp[$i]['workPerf']);
				if(!$result){
					mysql_close($con);
					return false;
				}
				
			} else {
				$result = $db->qry("UPDATE ".$this->workTable." SET empname='%s', address='%s', phone='%s', supervisor='%s', reason='%s', startDate='%s',".
					" endDate='%s', startWage='%s', endWage='%s', title='%s', workPerformed='%s'".
					"WHERE ".$this->idColumn."='%s' AND ".$this->jobIdColumn."='%s' AND workid='".$dbIndex."';" , 
					$workXp[$i]['wname'], $workXp[$i]['addr'], $workXp[$i]['phone'], $workXp[$i]['super'], $workXp[$i]['reason'], $workXp[$i]['startDate'], 
					$workXp[$i]['endDate'], $workXp[$i]['startSal'], $workXp[$i]['endSal'], $workXp[$i]['title'], $workXp[$i]['workPerf'], $id, $jobId);
				if(!$result){
					mysql_close($con);
					return false;
				}
			}
			$dbIndex++;
		}
		
		mysql_close($con);
		return true;
	}
	
	function showCand($posid, $start, $end, $max){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
	
		$returnString = '';
		$con = $db->connect();
		$check = $posid && is_int(intval($posid));
		if($check) {
			if($start && is_int(intval($start))) {
				$result = $db->qry("SELECT * FROM ".$this->userTable.", ".$this->appTable." WHERE ".$this->appTable.".".$this->idColumn." = ".$this->userTable.".".$this->idColumn.
					" AND ".$this->appTable.".posid = ".$posid." AND ".$this->idColumn." >'%s';" , $start);
				$forward = 1;
			} else if ($end){
				$forward = 0;
				$result = $db->qry("SELECT * FROM ".$this->userTable.", ".$this->appTable." WHERE ".$this->appTable.".".$this->idColumn." = ".$this->userTable.".".$this->idColumn.
					" AND ".$this->appTable.".posid = ".$posid." AND ".$this->idColumn." <='%s' ORDER BY ".$this->jobIdColumn." DESC;" , $end);
			} else{
				$forward = 1;

				$result = $db->qry("SELECT * FROM ".$this->userTable.", ".$this->appTable." WHERE ".$this->appTable.".".$this->idColumn." = ".$this->userTable.".".$this->idColumn.
					" AND ".$this->appTable.".posid = ".$posid.";" );

				$start = 0;
			}
		} else {
			if($start && is_int(intval($start))) {
				$result = $db->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->idColumn." >'%s';" , $start);
				$forward = 1;
			} else if ($end){
				$forward = 0;
				$result = $db->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->idColumn." <='%s' ORDER BY ".
					$this->idColumn." DESC;" , $end);
			} else{
				$forward = 1;
				$result = $db->qry("SELECT * FROM ".$this->userTable.";" );
				$start = 0;
			}
		}

		if(!$result) {
			mysql_close($con);
			return null;
		}
		$numRows = mysql_num_rows($result);
		if($numRows == 0) {
			$returnString .= "Oops! There are no results that match your query!";
		} else {
			$tableData = "";
			for($i = 0; $i < $max; $i++) {
				$row = mysql_fetch_assoc($result);
				if(!$row) {
					if($i == 0){
						$returnString .= "<br/>Oops! There are no results that match your query!";
					}
					break;
				} 
				
				$rowData = "<tr><td>".$row['userid'].'</td><td>'.$row['useremail']."</td><td>".$row['fname']."</td><td>".$row['lname'];
				$rowData .= "</td><td>";
				
				if($row['active']){
					$rowData .="Y";
				} else {
					$rowData .="N";
				}
				$rowData .= "</td></tr>";
				if($forward) {
					$tableData .= $rowData;
				} else {
					$tableData = $rowData.$tableData;
				}
			}
			if($i != 0) {
				$returnString .= "<table><tr><th>ID</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Active</th></tr>";
				$returnString .= $tableData."</table>";
			}
			if($forward){
				if(!$check) {
					$result = $db->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->idColumn."<'%s';" , $start);
				} else {
					$result = $db->qry("SELECT * FROM ".$this->userTable.", ".$this->appTable." WHERE ".$this->appTable.".".$this->idColumn." = ".$this->userTable.".".$this->idColumn.
					" AND ".$this->appTable.".posid = ".$posid." AND ".$this->userTable.".".$this->idColumn."<'%s';" , $start);
				}
				if(!$result) {
					mysql_close($con);
					return null;
				}
				if ( mysql_num_rows($result) != 0){
					$returnString .= '<a href="?';
					if($check){
						$returnString .= 'id='.$posid.'&';
					}
					$returnString .= 'before='.$start.'">Prev '.$max.'</a> ';
				}
				if ($numRows > $max) {
					$returnString .= '<a href="?';
					if($check){
						$returnString .= 'id='.$posid.'&';
					}
					$returnString .= 'after='.$row['userid'].'">Next '.$max.'</a>';
				}
			} else {
				if ($numRows > $max) {
					$newPrev = $row['userid'] - 1;
					$returnString .= '<a href="?';
					if($check){
						$returnString .= 'id='.$posid.'&';
					}
					echo'before='.$newPrev.'">Prev '.$max.'</a> ';
				}
				if(!$check) {
					$result = $db->qry("SELECT * FROM ".$this->userTable." WHERE ".$this->idColumn.">'%s';" , $end);
				} else {
					$result = $db->qry("SELECT * FROM ".$this->userTable.", ".$this->appTable." WHERE ".$this->appTable.".".$this->idColumn." = ".$this->userTable.".".$this->idColumn.
					" AND ".$this->appTable.".posid = ".$posid." AND ".$this->userTable.".".$this->idColumn.">'%s';" , $end);
				}
				if(!$result) {
					mysql_close($con);
					return null;
				}
				if ( mysql_num_rows($result) != 0){
					$returnString .= '<a href="?';
					if($check){
						$returnString .= 'id='.$posid.'&';
					}
					$returnString .= 'after='.$end.'">Next '.$max.'</a>';
				}
			}
		}
		
		mysql_close($con);
		return $returnString;
	}
	
	function addApp($id, $posid){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
	
		$con = $db->connect();
		$result = $db->qry("SELECT * FROM ".$this->appTable." WHERE ".$this->idColumn."='%s' AND ".$this->jobIdColumn."='%s';" , $id, $posid);
		if(!$result) {
			mysql_close($con);
			return false;
		}
		
		if(mysql_num_rows($result) == 0){
			$result = $db->qry("INSERT INTO ".$this->appTable." (".$this->idColumn.", ".$this->jobIdColumn.", appDate) VALUES ('%s', '%s', %s)",
				$id, $posid, "CURDATE()");
			if(!$result) {
				mysql_close($con);
				return false;
			}
			
			$result = $db->qry("UPDATE ".$this->postsTable." SET numcand=numcand+1 WHERE ".$this->jobIdColumn." = '%s';" , $posid);
			if(!$result) {
				mysql_close($con);
				return false;
			}
		}
		
		return true;
	}
}
?>