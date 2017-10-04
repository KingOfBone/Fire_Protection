<?php
	session_start();
	
	date_default_timezone_set("Asia/Jakarta");
	
	require_once ('config/koneksi.php');
	var_dump($_POST);
	if(isset($_POST["submit_login"])) {
		session_start();
		$username = strip_tags(trim($_POST["username"]));
		$password = strip_tags(trim(md5($_POST["password"])));

		$sql_login= mysql_query("SELECT * FROM tabel_users WHERE username = '$username' AND password = '$password'");
		echo "SELECT * FROM tabel_users WHERE username = '$username' AND password = '$password'";
		
		if(mysql_num_rows($sql_login) > 0) {
			$ip = $_SERVER["REMOTE_ADDR"];
			$row_administrator = mysql_fetch_array($sql_login);
			$_SESSION["level"]          = $row_administrator["level"];
			$_SESSION["kode_user"]      = $row_administrator["kode_user"];
			$_SESSION["nama_lengkap"]   = $row_administrator["nama_lengkap"];
			$_SESSION["username"]       = $row_administrator["username"];
			$_SESSION["images"]         = $row_administrator["images"];
			$_SESSION["no_anggota"]     = $row_administrator["no_anggota"];
			$date  = date("Y-m-d h:i:s");
			mysql_query("INSERT INTO loglogin VALUES ('','$_SESSION[username]','$date','$ip')");
			
			
			if($row_administrator["level"] == 'adm')
				header("location:http://localhost/MONPAR/?dashboard");
			else if($row_administrator["level"] == 'us')
				header("location:http://localhost/MONPAR/?apar_lihat");
			else if($row_administrator["level"] == 'mnj')
				header("location:http://localhost/MONPAR/?apar_lihat");
		}
		else {
			header("location:login.php?failed");
		}
	}
?>