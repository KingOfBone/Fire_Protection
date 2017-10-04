<?php
	session_start();
	$_SESSION["userID"] = "";
	$_SESSION["kodelogin"] = "";

	unset($_SESSION["userID"]);
	unset($_SESSION["kodelogin"]);

	session_unset();
	session_destroy();
	
	header("location:http://localhost/Portal/login.php");
?>