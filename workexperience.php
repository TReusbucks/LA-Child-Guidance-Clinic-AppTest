<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script language="Javascript">
function redirect1()
{
	document.location="Interests.html";
}

function addWork(){
	var addctrl = document.getElementById("divTables");
	var tables = document.getElementsByTagName("table");
	var count = tables.length + 1;
	var table = document.createElement("table");
	
	var rowCount = 0;
	
	var row = table.insertRow(rowCount);
	var cell1 = row.insertCell(0);
	var element = document.createElement("h3");
	cell1.appendChild(element);
	element.innerHTML="Company " + count + ":";
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","nameLabel"+count);
	cell1.innerHTML="Name of Employer:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","wname"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","addrLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="Address:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","waddress"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","phoneLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="Phone Number:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","wphone"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","superLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="Supervisor:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","wsupervisor"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","reasonLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="Reason for Leaving:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","wreason"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	var cell1 = row.insertCell(0);
	var element = document.createElement("h4");
	cell1.appendChild(element);
	element.innerHTML="Dates Employed:";
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","fromLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="From:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","date");
	element.setAttribute("name","wfrom"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","toLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="To:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","date");
	element.setAttribute("name","wto"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	var cell1 = row.insertCell(0);
	var element = document.createElement("h4");
	cell1.appendChild(element);
	element.innerHTML="Hourly Rates/Salary:";
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","startLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="Starting:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","wstarting"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","finalLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="Final:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","wfinal"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","titleLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="Job Title:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","wjobtitle"+count);
	cell1.appendChild(element);
	
	rowCount++;
	row = table.insertRow(rowCount);
	cell1 = row.insertCell(0);
	element = document.createElement("label");
	element.setAttribute("id","workLabel"+count);
	cell1.appendChild(element);
	element.innerHTML="Work Performed:";
	
	cell1 = row.insertCell(1);
	element = document.createElement("input");
	element.setAttribute("type","text");
	element.setAttribute("name","wworkperf"+count);
	cell1.appendChild(element);

	
	addctrl.appendChild(table);
}

function submitCheck(form){
	var tables = document.getElementsByTagName("table");
	var numWork = document.createElement("input");
	numWork.setAttribute("name", "numWork");
	numWork.setAttribute("value", tables.length);
	form.appendChild(numWork);
	
	return true;
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
?>
<form method=POST action="updateWork.php" onsubmit="submitCheck(this);">
<h2> Work Experience</h2>

<div id="divTables">
<?php
	require ("class_auth.php");
	$log = new auth_emp();
	$con = $log->connect();
	$result  = $log->qry("SELECT * FROM ".$log->workTable." WHERE ".$log->idColumn."='%s' AND ".$log->jobIdColumn."='1';" , $_SESSION['SESS_MEMBER_ID']);
	if(!$result){
		mysql_close($con);
		session_write_close();
		header("location: dbError.php");
		exit;
	}
	if (mysql_num_rows($result) == 0) :
?>
<table border= "0" id="table1">
<tr><td colspan ="2">
<tr><td><h3>Company 1:</h4></td>
<tr><td>Name of Employer:</td><td><input type ="text" name = "wname1" /></tr>
<tr><td>Address:</td><td><input type ="text" name = "waddress1" /></td></tr>
<tr><td>Phone Number:</td><td><input type ="text" name = "wphone1" /></td></tr>
<tr><td>Supervisor</td><td><input type ="text" name = "wsupervisor1" /></td></tr>
<tr><td>Reason for Leaving:</td><td><input type ="text" name = "wreason1" /></td></tr>
<tr><td><h4>Dates Employed:</h4></td>
<tr><td>From:</td><td><input type ="date" name="wfrom1"/></td></tr>
<tr><td>To:</td><td><input type ="date" name="wto1"/></td></tr>
<tr><td><h4>Hourly Rates/Salary:</h4></td></tr>
<tr><td>Starting:</td><td><input type ="text" name="wstarting1"/></td></tr>
<tr><td>Final:</td><td><input type ="text" name="wfinal1"/></td></tr>
<tr><td>Job Title:</td><td><input type ="text" name = "wjobtitle1" /></tr>
<tr><td>Work Performed:</td><td><input type ="text" name = "wworkperf1" /></tr>
</table>
<?php
	else:
		$i = 1;
		while ($row = mysql_fetch_assoc($result)) :
?>
<table border= "0" id=<?php echo '"table'.$i.'"'?>>
<tr><td colspan ="2">
<tr><td><h3>Company <?php echo $i ?>:</h4></td>
<tr><td>Name of Employer:</td><td><input type ="text" name = <?php echo '"wname'.$i.'" value="'.$row['empname'].'"';?> /></tr>
<tr><td>Address:</td><td><input type ="text" name = <?php echo '"waddress'.$i.'" value="'.$row['address'].'"';?> /></td></tr>
<tr><td>Phone Number:</td><td><input type ="text" name = <?php echo '"wphone'.$i.'" value="'.$row['phone'].'"';?> /></td></tr>
<tr><td>Supervisor</td><td><input type ="text" name = <?php echo '"wsupervisor'.$i.'" value="'.$row['supervisor'].'"';?> /></td></tr>
<tr><td>Reason for Leaving:</td><td><input type ="text" name = <?php echo '"wreason'.$i.'" value="'.$row['reason'].'"';?> /></td></tr>
<tr><td><h4>Dates Employed:</h4></td>
<tr><td>From:</td><td><input type ="date" name=<?php echo '"wfrom'.$i.'" value="'.$row['startDate'].'"';?>/></td></tr>
<tr><td>To:</td><td><input type ="date" name=<?php echo '"wto'.$i.'" value="'.$row['endDate'].'"';?>/></td></tr>
<tr><td><h4>Hourly Rates/Salary:</h4></td></tr>
<tr><td>Starting:</td><td><input type ="text" name=<?php echo '"wstarting'.$i.'" value="'.$row['startWage'].'"';?>/></td></tr>
<tr><td>Final:</td><td><input type ="text" name=<?php echo '"wfinal'.$i.'" value="'.$row['endWage'].'"';?>/></td></tr>
<tr><td>Job Title:</td><td><input type ="text" name = "<?php echo '"wjobtitle'.$i.'" value="'.$row['title'].'"';?> /></tr>
<tr><td>Work Performed:</td><td><input type ="text" name = <?php echo '"wworkperf'.$i.'" value="'.$row['workPerformed'].'"';?> /></tr>
</table>
<?php 
			$i++;
		endwhile;
	endif;
	mysql_free_result($result);
	mysql_close($con);
?>
</div>
<input type ="button" name = "addworkbtn" value = "Add Another Work Experience" onclick="addWork();" /> <br />
<input type ="submit" name = "savebtn" value = "Save" /><input type ="submit" name = "continuebtn" value = "Continue to Interests" onclick="redirect1();"/>

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
