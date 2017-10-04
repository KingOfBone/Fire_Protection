<?php
	ob_start();
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	include "../config/koneksi.php";

	if( ! isset($_SESSION["level"])) header("location:login.php?noakses");

	$querystring = mysql_real_escape_string(trim($_GET["mau_delete"]));
	$explode = explode(',', $querystring);
	
	$nama_table = $explode[0];
	$pk = $explode[1];
	$id = $explode[2];
	$loc = $explode[3];
	$id2 = !empty($_GET['id']) ? $_GET['id'] : null;
	
	/* $sql = [
		"pemeliharaan"=>"
			DELETE pml.* FROM pemeliharaan pml
			inner join sensor
				on sensor.kode_sensor=pml.kode_sensor
			inner join panel p
				on p.kode_panel=sensor.kode_panel				
			WHERE p.kode_panel ='$id'
		",
		"kejadian"=>"
			DELETE kjd.* FROM kejadian kjd
			inner join sensor
				on sensor.kode_sensor=kjd.kode_sensor
			inner join panel p
				on p.kode_panel=sensor.kode_panel				
			WHERE p.kode_panel ='$id'
		",
		"sensor"=>"
			DELETE s.* FROM sensor s
			inner join panel p
				on p.kode_panel=s.kode_panel				
			WHERE p.kode_panel ='$id'
		",
		"panel"=>"
			DELETE FROM panel
			WHERE panel.kode_panel ='$id'
		"
	];
	
	if($nama_table != 'pemeliharaan') {
		if($nama_table == 'sensor') {
			unset($sql['panel']);
		}
		else if($nama_table == 'kejadian') {
			unset($sql['panel']);
			unset($sql['sensor']);
		}
		else if($nama_table == 'pemeliharaan') {
			unset($sql['panel']);
			unset($sql['sensor']);
		}
		
		foreach($sql as $s) {
			mysql_query("$s") or die(mysql_error());		
		}
	}
	else {
		mysql_query("DELETE FROM $nama_table WHERE $pk ='$id'") or die(mysql_error());
	} */
	
	//echo "DELETE FROM $nama_table WHERE $pk ='$id'"; die();
	
	mysql_query("DELETE FROM $nama_table WHERE $pk ='$id'") or die(mysql_error());
	echo "location:../?$loc=$nama_table";
	die();
	header("location:../?$loc=$nama_table");
	
?>
