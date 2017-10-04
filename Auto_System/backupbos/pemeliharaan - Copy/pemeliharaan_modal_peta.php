<?php
	include "../../config/koneksi.php";
	include "../../config/utility.php";
	session_start();

	$id = $_POST['id'];
	$nama_table = $_POST['nama_table'];
	$objek = $_POST['objek'];
	
	$pk = ambil_pk($nama_table);
	$select = $objek == 'apar' ? 'gambar' : 'foto_lokasi';
	$sql = "SELECT $select from $nama_table WHERE $pk = '$id'";
	$sqldetail = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_array($sqldetail);
	
	$kolom_table = information_schema($nama_table);	
?>

<div class="row">

    <div class="col-md-8">
        <?php 
			$lihat_peta = lihat_peta($nama_table, $row, $objek);
			$gambar = $lihat_peta[0];
			$nama_gambar = $lihat_peta[1];
		?>
		
		<img src="<?php echo $gambar; ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo $nama_gambar; ?></p>
    </div>
</div>
