<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language = "Javascript">
function addcontrol()
{
	var addctrl = document.getElementById("span1");
	var element = document.createElement("input");
	element.setAttribute("type","text");
	var count2 = addctrl.childNodes.length;
	element.setAttribute("name","exNames"+count2);
	addctrl.appendChild(element);
}

function emergency()
{  
	var table = document.getElementById("emContact");
 	var rowCount = table.rows.length;
	var count1 = (rowCount - 1)/2;
    var row = table.insertRow(rowCount);
   
    var cell1 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","nameLabel"+count1);
	cell1.appendChild(element);
	element.innerHTML="Name:";

	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","name"+count1);
	cell1.appendChild(element);
		
	rowCount++;

    var row = table.insertRow(rowCount);
   
	cell1 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","numLabel"+count1);
	cell1.appendChild(element);
	element.innerHTML="Contact Number:";
	
	
	cell1 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","cnumber"+count1);
	cell1.appendChild(element);
}

function redirect1()
{
	document.location="education.php";
	
	
}
</script>

</head>

<body>
<?php
session_start();
if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')):
	session_write_close();
	header("location: login.php");
	exit;
elseif($_SESSION['SESS_LEVEL'] != '0'):
	session_write_close();
	echo "This is an employee account!";
else: 
	require_once ("cont/Cont_App.php");
	$app = new Cont_App();
	
	$user = $app->getPersonal($_SESSION['SESS_MEMBER_ID']);
	if(!$user){
		session_write_close();
		header("location: dbError.php");
		exit;
	}
	
?>
<h2> Personal Details </h2>
<form method=POST action="updatePersonal.php">
<table border= "0" id="table1"> 

<tr> 
<td>Last Name:</td><td> <input type = "text"  name = "LName" maxlength="20" value=<?php echo '"'.$user['lname'].'"'?>/></td></tr>
<tr><td>First Name:</td><td> <input type = "text"  name = "FName" maxlength="20" value=<?php echo '"'.$user['fname'].'"'?>/></td></tr>

<tr><td>M.I:</td><td> <input type = "text"  name = "MName" maxlength="1" value=<?php echo '"'.$user['minit'].'"'?>/> </td><tr>
<tr><td>Address:</td><td> <input type = "text"  name = "address" maxlength="60" value=<?php echo '"'.$user['address'].'"'?>/></td><tr> 

<tr><td>City:</td><td> <input type = "text"  name = "city" maxlength="60" value=<?php echo '"'.$user['city'].'"'?>/></td><tr>
<tr><td>State:</td><td> <input type = "text"  name = "state" maxlength="2" value=<?php echo '"'.$user['state'].'"'?>/></td><tr>
<tr><td>Zip:</td><td> <input type = "text"  name = "zip"  maxlength="5" value=<?php echo '"'.$user['zip'].'"'?>/></td><tr>
<tr><td>Telephone Number(s):</td><td> <input type = "text"  name = "tnumber" maxlength="15" value=<?php echo '"'.$user['phone'].'"'?>/></td><tr>
<tr><td>Social Security Number:</td><td> <input type = "text"  name = "ssn" maxlength="4" value=<?php echo '"'.$user['ssn'].'"'?>/> </td><tr>

<br/>
<br/>
<br/>

<tr><td>Are you over 18 years old?</td><td> <select name="isEighteen"> <option value="1" <?php if($user['isEighteen'] == 1){ echo 'selected="selected"';}?>> Yes </option> <option value="0" <?php if($user['isEighteen'] == 0){ echo 'selected="selected"';}?>> No </option></select></td></tr>
<tr><td>Do you have a reliable transportation to work?</td><td> <select name="hasTrans"> <option value="1" <?php if($user['hasTrans'] == 1){ echo 'selected="selected"';}?>> Yes </option> <option value="0" <?php if($user['hasTrans'] == 0){ echo 'selected="selected"';}?>> No </option></select></td></tr>
<tr><td colspan="2"> </td></tr><tr><td colspan="2"> </td></tr><tr><td colspan="2"> </td></tr><tr><td colspan="2"> </td></tr>
<tr><td>List Any other names you have used under which<br /> your past employment,education,or training can be verified: </td><td><span id = "span1"><input type = "text"  name = "exNames0" /></span></td></tr>
<tr><td colspan = "2"><input type ="button"  value = "Add" onClick = "addcontrol()"  /></td></tr>

</table>
<table id="emContact">
	<tr><td colspan = "2"><h4> Emergency Contact </h4></td></tr>
	<tr><td>Name:</td><td><input type = "text"  name = "name0" /></td></tr>
	<tr><td>Contact Number:</td><td><input type = "text"  name = "cnumber0" /></td></tr></table>
<table>
<tr><td colspan = "2"><input type ="button"  value = "Add" onClick = "emergency()"  /></td></tr>



</table>

<input type ="submit" name = "savebtn" value = "Save" /> <input type ="button" name = "continuebtn" value = "Continue to Education Details" onClick= "redirect1()" />

</form>
<?php
if(isset($_SESSION['STATUS']) && $_SESSION['STATUS'] != ""){
	echo $_SESSION['STATUS'];
	unset($_SESSION['STATUS']);
}
endif;
?>
</body>
</html>
