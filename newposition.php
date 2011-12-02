<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
include ("header.php");
session_start();
require_once("cont/Cont_Post.php");
$postCont = new Cont_Post();
if(isset($_SESSION['SESS_LEVEL']) && ($_SESSION['SESS_LEVEL'] == $postCont->adminLevel || $_SESSION['SESS_LEVEL'] == $postCont->hrLevel)):
?>
<form id="form1" name="form1" method="post" action="createPost.php">
  <table>
  <tr>
	  <td>Position Title</td>
	  <td>
		<input name="title" type="text" size="100" maxlength="100" />
	  </td>
  </tr>
  <tr>
  <td>Hiring Manager</td>
    <td><select name="select">
      <?php 
		$mangs = $postCont->getHiringMangs();
		if(!$mangs){
			session_write_close();
			header("location: dbError.php");
			exit;
		}
		
		foreach($mangs as $mang){
			echo '<option value="'.$mang['empid'].'">'.$mang['fname'].' '.$mang['lname'].'</option>';
		}
	  ?><option value='1'>Assign Later</option>
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
  <tr>
  <td>Additional Questions:</td>
  <td>
    <textarea name="quests" cols="100" rows="10"></textarea>
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
