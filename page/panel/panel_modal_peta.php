<?php
	ob_start();
	session_start();
	
	include "../../config/koneksi.php";
	include "../../config/utility.php";

	$id = $_POST['id'];
	$nama_table = $_POST['nama_table'];
	$objek = ucwords($_POST['objek']);
	
	/* $id = 2463;
	$nama_table = 'Apar';
	$objek = 'apar'; 
	
	echo "
		id = $id;
		$nama_table = $nama_table;
		$objek = $objek;
	"; */
	
	$sql = "SELECT * from panel WHERE kode_panel = '$id'";
	
	$sqldetail = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_array($sqldetail);
?>

<div class="row">

    <div class="col-md-8">
        <?php 
			$src = "images/$objek/$row[foto_lokasi]";
			$nama_gambar = "Lokasi Panel Lantai $row[lantai] / $row[no_panel] / $row[penempatan]";
		?>
		
		<img src="<?php echo $src; ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo "$nama_gambar"; ?></p>
    </div>
</div>
