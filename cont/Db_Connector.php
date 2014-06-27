<?php

class Db_Connector{
	var $hostname ='localhost:3306';
	var $database ='lacgc';
	var $dbUsername ='root';
	var $dbPassword ='';
	
	function connect(){
		$con = mysql_connect($this->hostname, $this->dbUsername, $this->dbPassword);
		if(!$con){
			die('Problem connecting to database:' . mysql_error());
		}
		mysql_select_db($this->database, $con) or die('Problem selecting database:' . mysql_error());
		return $con;
	}
	
	function qry(){
		$args = func_get_args();
		$query = array_shift($args);
		$args = array_map('mysql_real_escape_string', $args);
		array_unshift($args, $query);
		$query = call_user_func_array('sprintf',$args);
		$result = mysql_query($query) or die(mysql_error());
		return $result;
	}
}
?>