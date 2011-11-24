<html>
<body>
<?php
	session_start();
	require_once ("class_auth.php");
	$log = new auth_emp();
	if(isset($_SESSION['SESS_LEVEL']) && $_SESSION['SESS_LEVEL'] == $log->adminLevel){
		$max = 3;
		$con = $log->connect();
		$start = @trim($_GET['after']);
		$end = @trim($_GET['before']);
		if($start && is_int(intval($start))) {
			$result = $log->qry("SELECT * FROM ".$log->empTable." WHERE ".$log->empIdColumn.">'%s';" , $start);
			$forward = 1;
		} else if ($end){
			$forward = 0;
			$result = $log->qry("SELECT * FROM ".$log->empTable." WHERE ".$log->empIdColumn."<='%s' ORDER BY ".$log->empIdColumn." DESC;" , $end);
		} else{
			$forward = 1;
			$result = $log->qry("SELECT * FROM ".$log->empTable.";" );
			$start = 0;
		}
		if(!$result) {
			mysql_close($con);
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		$numRows = mysql_num_rows($result);
		if($numRows == 0) {
			echo "Oops! There are no results that match your query!";
		} else {
			echo "<table><tr><th>ID</th><th>Email</th><th>Account Type</th><th>First Name</th><th>Last Name</th></tr>";
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
			echo $tableData."</table>";
			if($forward){
				$result = $log->qry("SELECT * FROM ".$log->empTable." WHERE ".$log->empIdColumn."<'%s';" , $start);
				if(!$result) {
					mysql_close($con);
					session_write_close();
					header("location: dbError.php");
					exit;
				}
				if ( mysql_num_rows($result) != 0){
					echo '<a href="showemp.php?before='.$start.'">Prev '.$max.'</a> ';
				}
				if ($numRows > $max) {
					echo '<a href="showemp.php?after='.$row['empid'].'">Next '.$max.'</a>';
				}
			} else {
				if ($numRows > $max) {
					$newPrev = $row['empid'] - 1;
					echo '<a href="showemp.php?before='.$newPrev.'">Prev '.$max.'</a> ';
				}
				$result = $log->qry("SELECT * FROM ".$log->empTable." WHERE ".$log->empIdColumn.">'%s';" , $end);
				if(!$result) {
					mysql_close($con);
					session_write_close();
					header("location: dbError.php");
					exit;
				}
				if ( mysql_num_rows($result) != 0){
					echo '<a href="showemp.php?after='.$end.'">Next '.$max.'</a>';
				}
			}
		}
		
	} else {
		echo "You are not the admin I am looking for!";
	}
?>
</body>
</html>