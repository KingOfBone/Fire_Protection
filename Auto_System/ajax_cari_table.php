<?php
	$konek = mysqli_connect('localhost', 'root', '', 'fire_protection');
	
	$database = $_POST['database'];
	
	$sql = "
		select TABLE_NAME 'table' from information_schema.columns 
		where 
			table_schema = '$database'
		group by table_name asc
	";
	$sql = mysqli_query($konek, $sql);
	
	while($row = mysqli_fetch_assoc($sql)) {
		echo "<option>$row[table]</option>";
	}
?>