<html>
<body>
<?php
	include ("header.php");
	session_start();
	require_once ("class_auth.php");
	$log = new auth_emp();
	if(isset($_SESSION['SESS_LEVEL']) && $_SESSION['SESS_LEVEL'] == $log->candLevel){
		$result = $log->qry("SELECT * FROM ".$log->appTable.", ".$log->postsTable." WHERE ".$log->appTable." = ".$log->idColumn." = ".
			$_SESSION['SESS_MEMBER_ID']." AND ".$log->postsTable.".".$log->jobIdColumn." = ".$log->appTable.".".$log->jobIdColumn.";" );
		
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
			$tableData = "";
			for($i = 0; $i < $max; $i++) {
				$row = mysql_fetch_assoc($result);
				if(!$row) {
					if($i == 0){
						echo "<br/>Oops! There are no results that match your query!";
					}
					break;
				} else if($row['posid'] == $log->baseJob){
					$i--;
					continue;
				}
				
				
				$rowData = "<tr><td>".$row['posid']."</td><td>".$row['jobTitle']."</td><td>".$row['jobPostingDate']."</td><td>";
				
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
				echo '<table border="1"><tr><th>ID</th><th>Title</th><th>Posting Date</th><th>Active</th></tr>';
				echo $tableData."</table>";
			}
			if($forward){
				$result = $log->qry("SELECT * FROM ".$log->empTable." WHERE ".$log->empIdColumn."<'%s';" , $start);
				if(!$result) {
					mysql_close($con);
					session_write_close();
					header("location: dbError.php");
					exit;
				}
				if ( mysql_num_rows($result) != 0){
					echo '<a href=".php?before='.$start.'">Prev '.$max.'</a> ';
				}
				if ($numRows > $max) {
					echo '<a href=".php?after='.$row['empid'].'">Next '.$max.'</a>';
				}
			} else {
				if ($numRows > $max) {
					$newPrev = $row['empid'] - 1;
					echo '<a href="?before='.$newPrev.'">Prev '.$max.'</a> ';
				}
				$result = $log->qry("SELECT * FROM ".$log->empTable." WHERE ".$log->empIdColumn.">'%s';" , $end);
				if(!$result) {
					mysql_close($con);
					session_write_close();
					header("location: dbError.php");
					exit;
				}
				if ( mysql_num_rows($result) != 0){
					echo '<a href="?after='.$end.'">Next '.$max.'</a>';
				}
			}
		}
	}
?>
</body>
</html>