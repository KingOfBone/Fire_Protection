<?php
	include     "../../config/koneksi.php";
    include     "../../config/utility.php";
	
	
	//$kodeapp = 2;
	$kodeapp = $_POST['kodeapp'];
	
	$sql = "select * from master.gi where kodeapp = $kodeapp";
	$sql = mysql_query($sql);
?>
	<option value='semua'>Semua</option>
<?php
	while($row = mysql_fetch_array($sql)) {
?>
		<option value='<?php echo $row['kodegi']; ?>'><?php echo $row['namagi']; ?></option>
<?php
	}
?>