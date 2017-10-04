<?php
	include "../../config/koneksi.php";
	include "../../config/utility.php";
	session_start();

	$id = $_POST['id'];
	$nama_table = $_POST['nama_table'];
	$objek = $_POST['objek'];
	
	$pk = ambil_pk($nama_table);
	$sql = "SELECT * from $nama_table WHERE $pk = '$id'";
	$sqldetail = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_array($sqldetail);
	
	$kolom_table = information_schema($nama_table);	
?>

<div class="row">

    <div class="col-md-3">
        <?php 
			$lihat_peta = lihat_peta($nama_table, $row, $objek);
			$gambar = $lihat_peta[0];
			$nama_gambar = $lihat_peta[1];
		?>
		
		<img src="<?php echo $gambar; ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo "$nama_gambar"; ?></p>
    </div>
    <div class="col-md-8">
        <?php
			$sql = kumpulan_query_tampil_dibaris_awal($pk, $nama_table);
			$sqldetail = mysql_query($sql);
			$row = mysql_fetch_array($sqldetail);
			
			$i = 0;
			
			foreach($kolom_table as $kol) {
				$cek_komen = strpos($kol['Komen'], 'penting');
				$cek_primary = strpos($kol['Komen'], 'primary');
				$cek_fk = strpos($kol['Komen'], "fk");
				
				if($cek_komen !== false) {
					if($kol['Kolom'] != 'gambar') {
						$kolomtest = alias_kolom_fk($kol['Kolom'], $cek_primary);
						
						$ucwords_kolom_table = ucwords_kolom_table($kolomtest);
						$key = cari_ukuran($kol['Kolom']);
						
						if($key) {
							$ucwords_kolom_table = "$ucwords_kolom_table ($key)";
						}
						
						if($cek_fk !== false) {
							$explode = explode('___', $row['fk']);
							$kolom_explode = $explode[$i];
							
							$i++;
						}
						
						$kolom_explode = isset($kolom_explode) ? $kolom_explode : $kol['Kolom'];
						
						$kol_isi = tampil_kolom_isitable('lihat', $kolom_explode, $kol['Tipe'], $nama_table, $row, $cek_fk);
						
						$kolom_explode = null;
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
