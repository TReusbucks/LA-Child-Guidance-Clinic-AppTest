<html>
<body>
<?php
include ("header.php");
session_start();
require_once ("cont/Cont_Post.php");
$postCont = new Cont_Post();

$posid = @trim($_GET['posid']);

if(!$posid || $posid == 1):
	echo "Why are you trying to break my system?";
else:
	$row = $postCont->getPost($posid);
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
		echo "<table><tr><th>Post Title</th><td>".$row['jobTitle']."</td></tr>";
		echo "<tr><th>Description</th><td>".$row['jobDes']."</td></tr>";
		echo "<tr><th>Responsibilities</th><td>".$row['jobResp']."</td></tr>";
		echo "<tr><th>Requirements</th><td>".$row['jobReq']."</td></tr>";
		echo "<tr><th>Salary, Hours, and Benefits</th><td>".$row['jobSalBen']."</td></tr></table>";
	}
if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')):
?>
<a href="register.php">Register</a> <a href="login.php">Login</a>
<?php
	elseif($_SESSION['SESS_LEVEL'] == '0'):
		echo '<a href="apply.php?posid='.$row['posid'].'">Apply Now</a>';
	elseif($_SESSION['SESS_LEVEL'] == '1' || $_SESSION['SESS_LEVEL'] == '3'):
		echo '<a href="editposition.php?posid='.$row['posid'].'">Edit Position</a>';
	endif;
endif;
?>
</body>
</html>