<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
session_start();
require_once ("class_auth.php");
$log = new auth_emp();
if(isset($_SESSION['SESS_LEVEL']) && ($_SESSION['SESS_LEVEL'] == $log->adminLevel || $_SESSION['SESS_LEVEL'] == $log->hrLevel)):
?>
<form id="form1" name="form1" method="post" action="">
  <img src="../home-header.jpg" alt="Los Angeles Child Guidance Clinic" width="1200" height="113" />
  <table>
  <tr>
	  <td>Position Title</td>
	  <td>
		<input name="textfield" type="text" value="Clinic Supervisor" size="100" maxlength="100" />
	  </td>
  </tr>
  <tr>
  <td>Hiring Manager</td>
    <td><select name="select">
      <?php 
		$con = $log->connect();
		$result = $log->qry("SELECT * FROM ".$log->empTable." WHERE ".$log->userLevel."='%s';" , $log->hiringLevel);
		if(!$result) {
			mysql_close($con);
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		while($row = mysql_fetch_assoc($result)){
			echo '<option value="'.$row['empid'].'">'.$row['fname'].' '.$row['lname'].'</option>';
		}
		mysql_close($con);
	  ?><option value='0'>Assign Later</option>
    </td>
</tr>
<tr>
  <td>Description:</td>
  <td>
    <textarea name="description" cols="100" rows="10"></textarea>
  </td>
  </tr>
<tr>
  <td>Responsibilities:</td>
  <td>
    <textarea name="responsibilities" cols="100" rows="10"></textarea>
  </td>
  </tr>
  <tr>
  <td>Requirements:</td>
  <td>
    <textarea name="requirements" cols="100" rows="10"></textarea>
  </td>
  </tr>
  <tr>
  <td>Salary, Hours, and Benefits:</td>
  <td>
    <textarea name="perks" cols="100" rows="10"></textarea>
  </td>
  </tr>
  </table>

  <div align="center">
    <p>
      <input type="submit" name="Submit" value="Create" />
      <input type="reset" name="Submit2" value="Cancel" />
      </p>
  </div>
</form>
<?php
else:
	echo "You are in the wrong place, stranger.";
endif;
?>
</body>
</html>
