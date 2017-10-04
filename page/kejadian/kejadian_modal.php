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

    <div class="col-md-3">
        <?php 
			$src = "images/$objek/$row[gambar_sensor]";
			$nama_gambar = "$objek $row[no_sensor] / $row[penempatan_sensor]";
		?>
		
		<img src="<?php echo $src; ?>" width="188" height="272" class="img-responsive img-rounded center-block" />
        <p class="text-center"><?php echo "$nama_gambar"; ?></p>
    </div>
    <div class="col-md-8">
        <?php
			$kolom = [
				[
					"no_sensor"=>["label"=>"No Sensor", "name"=>"no_sensor", "tipe"=>"int"], 
					"kode_panel"=>["label"=>"Kode Panel", "name"=>"kode_panel", "tipe"=>"int"], 
					"penempatan_sensor"=>["label"=>"Penempatan Sensor", "name"=>"penempatan_sensor", "tipe"=>"varchar"], 
					"kondisi"=>["label"=>"Kondisi", "name"=>"kondisi", "tipe"=>"enum"]
				]
			];
			
			
			$array_keys = array_keys($kolom);
			
			foreach($array_keys as $arke) {
				foreach($kolom[$arke] as $key=>$kol) { 
					$label = $kol['label'];
					$name = $kol['name'];
					
					$value = $row[$name];
					
					if($kol['name'] == 'id_merk') {
						$sql_merk = "select merk from merk order by merk asc";
						$sql_merk = mysql_query($sql_merk);						
						$row_merk = mysql_fetch_array($sql_merk);						
						$value = $row_merk['merk'];
					}
		?>
					<div class="row">
						<div class="col-md-5"><label><?php echo $label; ?></label></div>
						<div class="col-md-1"> : </div>
						<div class="col-md-6"><?php echo $value; ?></div>
					</div>
		<?php
				}
			}
		?>
    </div>
</div>
