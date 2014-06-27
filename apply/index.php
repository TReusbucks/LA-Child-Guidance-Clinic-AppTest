<html>
<body>
<p><ul>Available Positions:
<?php
		$con = $log->connect();
		
		$result = $log->qry("SELECT * FROM ".$log->postsTable." WHERE active='1';");
		if(!$result) {
			mysql_close($con);
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		while ($row = mysql_fetch_assoc($result)) {
			if($row['posid'] != 1) {
				echo '<li><a href="../apply.php?posid='.$row['posid'].'">'.$row['jobTitle'].'</a></li>';
			}
		}
		mysql_close($con);
?>
</ul></p>
</body>
</html>