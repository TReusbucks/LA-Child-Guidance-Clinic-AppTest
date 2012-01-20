<html>
<body>
<?php
include ("header.php");
session_start();
require_once ("cont/Cont_App.php");
$app = new Cont_App();

$canid = @trim($_GET['canid']);

if(isset($_SESSION['SESS_MEMBER_ID']) && (trim($_SESSION['SESS_MEMBER_ID']) != '0')):
	if(!is_int(intval($canid))):
		session_write_close();
		header("location: showcand.php");
		exit;
	else:
		$row = $app->getPersonal($canid);
		if(!$row){
			if(isset($_SESSION['dbFlag'])){
				unset($_SESSION['dbFlag']);
				session_write_close();
				header("location: dbError.php");
				exit;
			} else {
				echo "Error! No such Post found!";
			}
		} else {
			echo "<table><tr><th>Name</th><td>".$row['lname'].", ".$row['fname']." ".$row['minit']."</td></tr>";
			echo "<tr><th>Candidate ID</th><td>".$canid."</td></tr>";
			echo "<tr><th>Address</th><td>".$row['address']."</td></tr>";
			echo "<tr><th>City</th><td>".$row['city']."</td></tr>";
			echo "<tr><th>State</th><td>".$row['state']."</td></tr>";
			echo "<tr><th>Zip</th><td>".$row['zip']."</td></tr>";
			echo "<tr><th>Phone</th><td>".$row['phone']."</td></tr>";
			echo "<tr><th>Is Eighteen?</th><td>";
			if($row['isEighteen'] == 1)
				echo "Yes";
			else
				echo "No";
			echo "</td></tr>";
			echo "<tr><th>Has Transportation?</th><td>";
			if($row['hasTrans'] == 1)
				echo "Yes";
			else
				echo "No";
			echo "</td></tr></table>";
		}
	if(isset($_SESSION['ERRMSG'])){
		echo "<p>".$_SESSION['ERRMSG']."</p>";
		unset($_SESSION['ERRMSG']);
	}
	endif;

else:
	echo "<p>You should not be here!</p>";
endif;
	
?>
</body>
</html>