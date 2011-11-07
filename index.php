<html>
<body>
<?php
session_start();
if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')): ?>
<p><a href="login.php">Log In</a></p>
<p><a href="register.php">Create an Account</a></p>
<?php
else: ?>
<p>Greetings Registered Member!</p>
<p><a href="logout.php">Log Out</a></p>
<?php
endif;
?>
</body>
</html>