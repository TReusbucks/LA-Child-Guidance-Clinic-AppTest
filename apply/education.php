<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Education</title>
<script language = "Javascript">

var count1 = 1 ;

var count2 = 2;

function addcollege()
{
	var table = document.getElementById("table2");
 	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	
    var cell1 = row.insertCell(0);
	cell1.colSpan="2";
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	cell1.appendChild(element);
	document.getElementById("label"+count1).innerHTML="College";
	
	
	count1++;
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
    var cell1 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell1.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Name:";

	var cell2 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell2.appendChild(element);
		
	count1++;

	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Location:";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	count1++;
	
	
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="# of Years Completed:";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	count1++;
	
	
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Did you Graduate?";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	
	/*var cell4 = row.insertCell(1);
	var element = document.createElement("select");
	element.options[0]= new Option("selection1","Yes");
	element.options[1]= new Option("selection2","No");
	cell4.appendchild(element);*/
	
	
		
	count1++;
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Major Studies:";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	count1++;
	
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Degree/Diploma/Certificate:";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	count1++;
	
	
	
}

function addother()
{
	var table = document.getElementById("table4");
 	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	
    var cell1 = row.insertCell(0);
	cell1.colSpan="2";
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	cell1.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Other";
	
	
	count1++;
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
    var cell1 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell1.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Name:";

	var cell2 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell2.appendChild(element);
		
	count1++;

	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Location:";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	count1++;
	
	
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="# of Years Completed:";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	count1++;
	
	
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Did you Graduate?";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	
	/*var cell4 = row.insertCell(1);
	var element = document.createElement("select");
	element.options[0]= new Option("selection1","Yes");
	element.options[1]= new Option("selection2","No");
	cell4.appendchild(element);*/
	
	
		
	count1++;
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Major Studies:";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	count1++;
	
	
	var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
   
	var cell3 = row.insertCell(0);
	var element = document.createElement("label");
	element.setAttribute("id","label"+count1);
	var addctrl = document.getElementById("span2");
	cell3.appendChild(element);
	document.getElementById("label"+count1).innerHTML="Degree/Diploma/Certificate:";
	
	
	var cell4 = row.insertCell(1);
	var element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","text"+count1);
	var addctrl = document.getElementById("span2");
	cell4.appendChild(element);
	
	count1++;
	
	
	
}

function redirect1()
{
	document.location="workexperience.php";
	
	
}





</script>
</head>

<body>
<?php
session_start();
if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')):
	session_write_close();
	header("location: ../login.php");
	exit;
elseif($_SESSION['SESS_LEVEL'] != '0'):
	session_write_close();
	echo "This is an employee account!";
else: 
	
?>
<h2>Education </h2>
<form>
<table border= "0" id="table1">
<tr><td colspan ="2"><h4>High School</h4></td></tr> 
<tr><td>Name:</td><td><input type ="text" name = "sname" /></td></tr>
<tr><td>Location:</td><td><input type ="text" name = "slocation" /></td></tr>
<tr><td># of Years Completed:</td><td><input type ="text" name = "syears" /></td></tr>
<tr><td>Did you graduate?</td><td><select> <option> Yes </option> <option> No </option></select></td></tr>
<tr><td>Major Studies:</td><td><input type ="text" name = "smajor" /></td></tr>
<tr><td>Degree/Diploma/Certificate</td><td><select> <option> Degree </option> <option> Diploma </option><option>Certificate</option></select></td></tr>


</table>

<table border= "0" id="table2">
<tr><td colspan ="2"><h4>College</h4></td></tr> 
<tr><td>Name:</td><td><input type ="text" name = "cname" /></td></tr>
<tr><td>Location:</td><td><input type ="text" name = "clocation" /></td></tr>
<tr><td># of Years Completed:</td><td><input type ="text" name = "cyears" /></td></tr>
<tr><td>Did you graduate?</td><td><select> <option> Yes </option> <option> No </option></select></td></tr>
<tr><td>Major Studies:</td><td><input type ="text" name = "cmajor" /></td></tr>
<tr><td>Degree/Diploma/Certificate</td><td><select> <option> Degree </option> <option> Diploma </option><option>Certificate</option></select></td></tr>
</table><br/>

<input type ="button"  value = "Add" onClick = "addcollege()"  />


<table border= "0" id="table3">
<tr><td colspan ="2"><h4>Trade School</h4></td></tr> 
<tr><td>Name:</td><td><input type ="text" name = "tname" /></td></tr>
<tr><td>Location:</td><td><input type ="text" name = "tlocation" /></td></tr>
<tr><td># of Years Completed:</td><td><input type ="text" name = "tyears" /></td></tr>
<tr><td>Did you graduate?</td><td><select> <option> Yes </option> <option> No </option></select></td></tr>
<tr><td>Major Studies:</td><td><input type ="text" name = "tmajor" /></td></tr>
<tr><td>Degree/Diploma/Certificate</td><td><select> <option> Degree </option> <option> Diploma </option><option>Certificate</option></select></td></tr>
</table>


<table border= "0" id="table4">
<tr><td colspan ="2"><h4>Other</h4></td></tr> 
<tr><td>Name:</td><td><input type ="text" name = "oname" /></td></tr>
<tr><td>Location:</td><td><input type ="text" name = "olocation" /></td></tr>
<tr><td># of Years Completed:</td><td><input type ="text" name = "oyears" /></td></tr>
<tr><td>Did you graduate?</td><td><select> <option> Yes </option> <option> No </option></select></td></tr>
<tr><td>Major Studies:</td><td><input type ="text" name = "omajor" /></td></tr>
<tr><td>Degree/Diploma/Certificate</td><td><select> <option> Degree </option> <option> Diploma </option><option>Certificate</option></select></td></tr>
</table>
<br/>
<input type ="button"  value = "Add" onClick = "addother()"  />

<h4>Training and Job Skills</h4>
In addition to your work history, what other background, experiences, classes, training, seminars,<br/>
credentials licenses,special skills or aptitudes, knowledge of office machines or other equipment, <br/>
or other qualifications do you have that especially qualify you for the position you are seeking?<br />
<textarea cols="50" rows="5">

</textarea>

<h4>Military Experience</h4>
List any military experience you have that may be relevant to the position for which you are applying.<br/>
If relevant, please also include your branch of service, highest rank attained, and any special training<br/> 
received. Also list your type of discharge OR any reserve obligations you have: <br/>
<textarea cols="50" rows="5">
</textarea>

<h4>Verification of Employment</h4>
May we contact your current employer?</td><td><select> <option> Yes </option> <option> No </option></select></td></tr>
If you have any previous employers you do not wish us to contact, please list them here plus the reason they may not be contacted:
<textarea cols="50" rows="5">
</textarea><br/><br/>


<input type="button" name="continuebtn" value="Continue to Work Experience Details" onclick="redirect1()">

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
