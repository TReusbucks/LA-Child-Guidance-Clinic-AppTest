<html>
<head>
<script LANGUAGE="Javascript">
function check(form){
	if(form.username.value == ""){
		document.getElementById('error').innerHTML = 'Please enter a valid email address';
		form.username.focus();
		return false;
	} else if(form.password.value == ""){
		document.getElementById('error').innerHTML = 'Please enter a password';
		form.password.focus();
		return false;
	}
	
	return true;
}
</script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')): ?>
<form action="log.php" method=POST onsubmit="return check(this);">
<table>
	<tr>
		<td>Email:</td>
		<td><input type="text" name="username"/></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password"/></td>
	</tr>
	<tr>
		<td> Account: </td>
		<td>
			<select name="level">
			<option value="0">Applicant</option>
			<option value="1">Employee</option>
			</select>
		</td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" value="Log In" /></td>
	</tr>
</table>
</form>
<p id='error'>
<?php 
if(isset($_SESSION['ERRMSG']) && $_SESSION['ERRMSG'] != ""){
	echo $_SESSION['ERRMSG'];
	unset($_SESSION['ERRMSG']);
}?>
</p>
<?php
else: ?>
<p>Oh dear, you're already logged in!</p>
<p><a href="logout.php">Log Out</a></p>
<?php
endif;
?>

</body>
</html>