<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="Javascript">
function redirect1()
{
	history.go(-1);
}

function checkSubmit(form, value){
	var pos = document.createElement("input");
	pos.setAttribute("type", "hidden");
	pos.setAttribute("name", "posid");
	pos.setAttribute("value", value);
	form.appendChild(pos);
	
	return true;
}
</script>
</head>

<body>
<?php
include ("header.php");
session_start();
require_once ("cont/Cont_Post.php");
$postCont = new Cont_Post();
if(isset($_SESSION['SESS_LEVEL']) && ($_SESSION['SESS_LEVEL'] == $postCont->adminLevel || $_SESSION['SESS_LEVEL'] == $postCont->hrLevel)):
	$posid = @trim($_GET['posid']);
	if(!$posid || $posid == 1):
		echo "EAAAAGGGLLEEEE!";
	else:
		$post = $postCont->getPost($posid);

		if(!$post):
			if(isset($_SESSION['dbFlag'])){
				unset($_SESSION['dbFlag']);
				session_write_close();
				header("location: dbError.php");
				exit;
			} else {
				echo "<p>Error! No such Post found!</p>";
			}
		else:
	
?>
<?php echo '<form id="form1" name="form1" method="post" action="editPost.php" onsubmit="checkSubmit(this, '.$posid.');">'; ?>
  <table>
  <tr>
	  <td>Position Title</td>
	  <td>
<?php
		echo '<input name="title" type="text" size="100" maxlength="100" value="'.$post['jobTitle'].'"/>';
?>
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
				echo '<option value="'.$mang['empid'].'"';
				if($post['manager'] == $mang['empid']){
					echo ' selected="selected" ';
				}
				echo'>'.$mang['fname'].' '.$mang['lname'].'</option>';
			}
	  ?><option value='1'>Assign Later</option>
    </td>
</tr>
<tr>
  <td>Description:</td>
  <td>
    <textarea name="description" cols="100" rows="10"><?php echo $post['jobDes'];?></textarea>
  </td>
  </tr>
<tr>
  <td>Responsibilities:</td>
  <td>
    <textarea name="responsibilities" cols="100" rows="10"><?php echo $post['jobResp'];?></textarea>
  </td>
  </tr>
  <tr>
  <td>Requirements:</td>
  <td>
    <textarea name="requirements" cols="100" rows="10"><?php echo $post['jobReq'];?></textarea>
  </td>
  </tr>
  <tr>
  <td>Salary, Hours, and Benefits:</td>
  <td>
    <textarea name="perks" cols="100" rows="10"><?php echo $post['jobSalBen'];?></textarea>
  </td>
  </tr>
  <tr>
  <td>Additional Questions:</td>
  <td>
    <textarea name="quests" cols="100" rows="10"><?php echo $post['jobQuestions'];?></textarea>
  </td>
  </tr>
  </table>

  <div align="center">
    <p>
      <input type="submit" name="Submit" value="Save" />
      <input type="button" name="Submit2" value="Cancel" onClick="redirect1();"/>
      </p>
  </div>
</form>
<?php

		endif;
	endif;
else:
	echo "You are in the wrong place, stranger.";
endif;
?>
</body>
</html>
