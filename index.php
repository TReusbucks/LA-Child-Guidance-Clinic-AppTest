<html>
<body>
<?php
include ("header.php");
session_start();
require_once ("cont/Cont_Post.php");
$postCont = new Cont_Post();
if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')): ?>
<p><a href="login.php">Log In</a></p>
<p><a href="register.php">Create an Account</a></p>
<p>Available Positions:<ul>
<?php
		$posts = $postCont->getAvailPosts();
		if(!$posts) {
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		for ($i = 0; $i < count($posts); $i++) {
			echo '<li><a href="postdetails.php?posid='.$posts[$i]['posid'].'">'.$posts[$i]['jobTitle'].'</a></li>';
		}
		
?>
</ul></p>
<?php
else: 
	if($_SESSION['SESS_LEVEL'] == '0'):
	?>
<p>Greetings Registered Member!</p>
<p><a href="personaldata.php">Update Profile</a></p>
<p>Available Positions:<ul>
<?php
		$posts = $postCont->getAvailPosts();
		if(!$posts) {
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		for ($i = 0; $i < count($posts); $i++) {
			echo '<li><a href="postdetails.php?posid='.$posts[$i]['posid'].'">'.$posts[$i]['jobTitle'].'</a></li>';
		}
?>
</ul></p>
<?php
if(isset($_SESSION['STATUS']) && $_SESSION['STATUS'] != ""){
			echo $_SESSION['STATUS'];
			unset($_SESSION['STATUS']);
	}
?>
<?php
	elseif($_SESSION['SESS_LEVEL'] == '1'):
?>
<p>Greetings HR Employee!</p>
<p><a href="newposition.php">Create a New Post</a></p>
<p><a href="showposts.php">Show Existing Positions</a></p>
<?php
	elseif($_SESSION['SESS_LEVEL'] == '3'):
?>
<p>Greetings Admin!</p>
<p><a href="empregister.php">Add Employee Account</a></p>
<p><a href="showemp.php">Show Current Employee Accounts</a></p>
<p><a href="showcand.php">Show Current Candidate Accounts</a></p>
<p><a href="newposition.php">Create a New Post</a></p>
<p><a href="showposts.php">Show Existing Positions</a></p>
<p><a href="hr_management/">See HR Mockups</a></p>
<p><a href="application_forms/">See Form Mockups</a></p>
<?php 
	endif;
?>
<p><a href="logout.php">Log Out</a></p>
<?php
endif;
?>
</body>
</html>