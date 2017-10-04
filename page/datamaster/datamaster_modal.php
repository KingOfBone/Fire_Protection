<?php
	include "../../config/koneksi.php";
	include "../../config/utility.php";
	session_start();

	$id = $_POST['id'];
	$nama_table = $_POST['nama_table'];
	
	$pk = ambil_pk($nama_table);
	$sql = "SELECT * from $nama_table WHERE $pk = '$id'";
	$sqldetail = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_array($sqldetail);
	
	$kolom_table = information_schema($nama_table);	
?>

<div class="row">

    <div class="col-md-3">
        <?php 
			if($nama_table == 'APAR') {
				$gambar = $row["gambar"] == "" ? "images/foto/no-images.png" : "images/APAR/".$row["gambar"];
			}
			else if($nama_table == 'LOKASI') {
				$gambar = $row["foto"] == "" ? "images/foto/no-images.png" : "images/Lokasi_Apar/".$row["foto"];
			}
			else
				$gambar = "images/foto/no-images.png";
			
			$nama_gambar = empty($row["gambar"]) ? "no-images.png" : $row["gambar"];
			$nama_gambar = empty($row["foto"]) ? "no-images.png" : $row["foto"];
		?>
		
		<img src="<?php echo $gambar; ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo $nama_gambar; ?></p>
    </div>
    <div class="col-md-8">
        <?php
			$sqldetail = mysql_query("SELECT * from $nama_table WHERE $pk = '$id'") or die (mysql_error());
			$row = mysql_fetch_array($sqldetail);
			
			foreach($kolom_table as $kol) {
				$cek_komen = strpos($kol['Komen'], 'penting');
				if($cek_komen !== false) {
					if($kol['Kolom'] != 'gambar') {
						$ucwords_kolom_table = ucwords_kolom_table($kol['Kolom']);
						$key = cari_ukuran($kol['Kolom']);
						if($key) {
							$ucwords_kolom_table = "$ucwords_kolom_table ($key)";
						}
						
						$kol_isi = tampil_kolom_isitable('lihat', $kol['Kolom'], $kol['Tipe'], $nama_table, $row);
						
		?>
						<div class="row">
						  <div class="col-md-5"><label><?php echo $ucwords_kolom_table; ?></label></div>
						  <div class="col-md-1"> : </div>
						  <div class="col-md-6"><?php echo $kol_isi; ?></div>
						</div>
		<?php
					}
				}
			}
		?>
    </div>
</div>
