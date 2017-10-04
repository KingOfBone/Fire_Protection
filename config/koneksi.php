<?php
	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db	  = "fire_protection";
	$koneksimysql = mysql_connect("$host","$user","$pass");
	mysql_select_db("$db",$koneksimysql) or die (mysql_error());

?>