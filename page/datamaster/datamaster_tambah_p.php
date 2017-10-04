<?php
	include('../../config/utility.php');
	
	$nama_table = 'APAR';
	
	$kolom_table = information_schema($nama_table);
	
	$table_array = ['APAR', 'LOKASI'];
	
	var_dump($_POST);
	
	
	
	$FILES = in_array($nama_table, $table_array) ? $_FILES : null;
	
	insert($nama_table, "?input_tambah=$nama_table", $_POST, $kolom_table, $FILES);		
	
	
	echo $_SESSION['sql'];
?>