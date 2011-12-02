<html>
<head>
<script LANGUAGE="Javascript">
function check(form){
	if(form.fname.value == "" ){
		document.getElementById('error').innerHTML = 'Please enter a valid first name';
		form.fname.focus();
		return false;
	} else if(form.lname.value == "" ){
		document.getElementById('error').innerHTML = 'Please enter a valid last name';
		form.lname.focus();
		return false;
	} else if(form.username.value == "" ){
		document.getElementById('error').innerHTML = 'Please enter a valid email address';
		form.username.focus();
		return false;
	} else if(form.username.value != form.rusername.value ){
		document.getElementById('error').innerHTML = 'The email fields do not match';
		form.username.value = "";
		form.rusername.value = "";
		form.username.focus();
		return false;
	} else if(form.password.value == ""){
		document.getElementById('error').innerHTML = 'Please enter a password';
		form.password.focus();
		return false;
	} else if(form.rpassword.value != form.password.value){
		document.getElementById('error').innerHTML = 'The password fields do not match';
		form.password.value = "";
		form.rpassword.value = "";
		form.password.focus();
		return false;
	}
	
	var em = form.username.value;
	var atpos = em.indexOf("@");
	var dotpos = em.lastIndexOf(".");
	
	if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= em.length) {
		document.getElementById('error').innerHTML = 'Please enter a valid email address';
		form.username.value = "";
		form.username.focus();
		return false;
	}
	
	return true;
}
</script>
</head>
<body>
<?php
	include ("header.php");
?>
<form action="createAppAccount.php" method=POST onsubmit="return check(this);">
<table>
	<tr>
		<td>First Name:</td>
		<td><input type="text" name="fname" maxlength="20"/></td>
	</tr>
	<tr>
		<td>Last Name:</td>
		<td><input type="text" name="lname" maxlength="20"/></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type="text" name="username" maxlength="60"/></td>
	</tr>
	<tr>
		<td>Email Again:</td>
		<td><input type="text" name="rusername" maxlength="60"/></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password"/></td>
	</tr>
	<tr>
		<td>Password Again:</td>
		<td><input type="password" name="rpassword"/></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" value="Register" /></td>
	</tr>
</table>
</form>
<p id='error'>
<?php 
session_start();
if(isset($_SESSION['ERRMSG'])){
	echo $_SESSION['ERRMSG'];
	unset($_SESSION['ERRMSG']);
}?>
</p>
</body>
</html>