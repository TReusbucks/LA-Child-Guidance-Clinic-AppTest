<?php

class Cont_Post{	
	var $postsTable = 'positions';
	var $empTable = 'employees';
	
	var $userLevel = 'userlevel';
	var $candLevel = "0";
	var $hrLevel = "1";
	var $hiringLevel = "2";
	var $adminLevel = "3";
	
	var $empIdColumn = 'empid';
	var $jobIdColumn = 'posid';
	var $baseJob = 1;
	
	function getAvailPosts(){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		$con = $db->connect();

		$result = $db->qry("SELECT * FROM ".$this->postsTable." WHERE active='1';");
		if(!$result) {
			mysql_close($con);
			return null;
		}
			
		$returnArray = array();
		while ($row = mysql_fetch_assoc($result)) {
			if($row['posid'] != $this->baseJob) {
				$returnArray[] = $row;
			}
		}
		mysql_close($con);
		
		return $returnArray;
	}
	
	function createPost($post, $id){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		$con = $db->connect();
		
		$success = $db->qry("INSERT INTO ".$this->postsTable." (manager, hremp, jobTitle, jobDes, jobResp, jobReq, jobSalBen, jobPostingDate, jobQuestions)"
				." VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', %s, '%s')", 
				$post['hman'], $id, $post['title'], $post['desc'], $post['resp'], $post['req'], $post['perks'], $post['date'], $post['quests']);
		mysql_close($con);
		return $success;
	}
	
	function editPost($post, $id, $posid){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		$con = $db->connect();
		
		$success = $db->qry("UPDATE ".$this->postsTable." SET manager = '%s', hremp = '%s', jobTitle = '%s', jobDes = '%s', jobResp = '%s', 
			jobReq = '%s', jobSalBen = '%s', jobQuestions = '%s' WHERE posid='".$posid."';", 
			$post['hman'], $id, $post['title'], $post['desc'], $post['resp'], $post['req'], $post['perks'], $post['quests']);
		mysql_close($con);
		return $success;
	}
	
	function getHiringMangs(){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		$con = $db->connect();
		
		$result = $db->qry("SELECT * FROM ".$this->empTable." WHERE ".$this->userLevel."='%s';" , $this->hiringLevel);
		if(!$result) {
			mysql_close($con);
			return null;
		}
		
		$returnArray = array();
		while($row = mysql_fetch_assoc($result)){
			$returnArray[] = $row;
		}
		
		return $returnArray;
	}
	
	function getPost($posid){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		$con = $db->connect();
	
		$result = $db->qry("SELECT * FROM ".$this->postsTable." WHERE posid = ".$posid.";" );
		if(!$result) {
			mysql_close($con);
			$_SESSION['dbFlag'] = true;
			return null;
		}

		$post = mysql_fetch_assoc($result);
		mysql_close($con);
		return $post;
	}
	
	function showPosts($start, $end, $max){
		require_once('Db_Connector.php');
		$db = new Db_Connector();
		$con = $db->connect();
		
		$returnString = "";
		if($start && is_int(intval($start))) {
			$result = $db->qry("SELECT * FROM ".$this->postsTable.", ".$this->empTable." WHERE ".$this->postsTable.".manager = ".
			$this->empTable.".".$this->empIdColumn." AND ".$this->jobIdColumn." >'%s';" , $start);
			$forward = 1;
		} else if ($end){
			$forward = 0;
			$result = $db->qry("SELECT * FROM ".$this->postsTable.", ".$this->empTable." WHERE ".$this->postsTable.".manager = ".
			$this->empTable.".".$this->empIdColumn." AND ".$this->jobIdColumn." <='%s' ORDER BY ".$this->jobIdColumn." DESC;" , $end);
		} else{
			$forward = 1;
			$result = $db->qry("SELECT * FROM ".$this->postsTable.", ".$this->empTable." WHERE ".$this->postsTable.".manager = ".
			$this->empTable.'.'.$this->empIdColumn.";" );
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
			$tableData = "";
			for($i = 0; $i < $max; $i++) {
				$row = mysql_fetch_assoc($result);
				if(!$row) {
					if($i == 0){
						$returnString .= "<br/>Oops! There are no results that match your query!";
					}
					break;
				} else if($row['posid'] == $this->baseJob){
					$i--;
					continue;
				}
				$rowData = "<tr><td>".$row['posid'].'</td><td><a href="postdetails.php?posid='.$row['posid'].'">'.$row['jobTitle'];
				$rowData .= "</a></td><td>".$row['fname']." ".$row['lname'];
				$rowData .= '</td><td><a href="showcand.php?id='.$row['posid'].'">'.$row['numcand']."</td><td>".$row['jobPostingDate']."</td><td>";
				
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
				$returnString .= '<table border="1"><tr><th>ID</th><th>Title</th><th>Hiring Manager</th><th>Number of Candidates</th><th>Posting Date</th><th>Active</th></tr>';
				$returnString .= $tableData."</table>";
			}
			if($forward){
				$result = $db->qry("SELECT * FROM ".$this->postsTable." WHERE ".$this->jobIdColumn." <'%s';" , $start);
				if(!$result) {
					mysql_close($con);
					return null;
				}
				if ( mysql_num_rows($result) != 0){
					$returnString .= '<a href="?before='.$start.'">Prev '.$max.'</a> ';
				}
				if ($numRows > $max) {
					$returnString .= '<a href="?after='.$row['posid'].'">Next '.$max.'</a>';
				}
			} else {
				if ($numRows > $max + 1) {
					$newPrev = $row['posid'] - 1;
					$returnString .= '<a href="?before='.$newPrev.'">Prev '.$max.'</a> ';
				}
				$result = $db->qry("SELECT * FROM ".$this->postsTable." WHERE ".$this->jobIdColumn." >'%s';" , $end);
				if(!$result) {
					mysql_close($con);
					return null;
				}
				if ( mysql_num_rows($result) != 0){
					$returnString .= '<a href="?after='.$end.'">Next '.$max.'</a>';
				}
			}
		}
		
		$returnString .= '<p><a href="newposition.php">Create New Post</a></p>';
		
		mysql_close($con);
		return $returnString;
	}
}

?>