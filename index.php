<html>
<body>
<?php
session_start();
if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')): ?>
<p><a href="login.php">Log In</a></p>
<p><a href="register.php">Create an Account</a></p>
<?php
else: 
	if($_SESSION['SESS_LEVEL'] == '0'):?>
<p>Greetings Registered Member!</p>
<p><a href="personaldata.php">Update Profile</a></p>
<?php
	elseif($_SESSION['SESS_LEVEL'] == '3'):
?>
<p>Greetings Admin!</p>
<p><a href="empregister.php">Add Employee Account</a></p>
<p><a href="showemp.php">Show Current Employee Accounts</a></p>
<?php 
	endif;
?>
<p><a href="logout.php">Log Out</a></p>
<?php
endif;
?>
</body>
</html>