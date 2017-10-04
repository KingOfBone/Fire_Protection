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
	
	$sql = "SELECT * from sensor WHERE kode_sensor = '$id'";
	
	$sqldetail = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_array($sqldetail);
?>

<div class="row">

    <div class="col-md-8">
        <?php 
			$src = "images/$objek/$row[lokasi_sensor]";
			$nama_gambar = "Lokasi Sensor $row[no_sensor] / $row[penempatan_sensor]";
		?>
		
		<img src="<?php echo $src; ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo "$nama_gambar"; ?></p>
    </div>
</div>
