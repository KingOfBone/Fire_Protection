
<title>Cari Kolom</title>

<form method='post' action=''>
	<table>
		<tr>
			<td>Database</td>
			<td>:</td>
			<td>
				<select onChange='cari_table(this.value)' name='nama_database'>
					<option value='kosong'> --- </option>
					<option value='apar'>Apar</option>
					<option value='fire_protection'>Fire Protection</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Table</td>
			<td>:</td>
			<td>
				<select id='hasil_ajax' name='nama_table'>
					
				</select>
			</td>
		</tr>
		
		<tr>
			<td><input type='submit' value='Bikin dah'></td>
		</tr>
	</table>
</form>



<script>
	function cari_table(database) {
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {		
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("hasil_ajax").innerHTML = this.responseText;
			}
		};
		
		xhttp.open("POST", "ajax_cari_table.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("database="+database);
	}
</script>


<?php
	if(!empty($_POST)) {
		$konek = mysqli_connect('localhost', 'root', '', 'fire_protection');
		
		$table_schema = $_POST['nama_database'];
		$table_name = $_POST['nama_table'];
		
		$sql = "
			select column_name 'kol', data_type 'tipe' from information_schema.columns 
			where 
				table_schema = '$table_schema' AND 
				table_name = '$table_name'
		";
		$sql = mysqli_query($konek, $sql);
		while($row = mysqli_fetch_assoc($sql)) {
			$database[] = ['kol'=>$row['kol'], 'tipe'=>$row['tipe']];
		}
		
		echo "
			<h1>Database : $table_schema</h1>
			<h1>Tabel : $table_name</h1>
		";
		
		
		echo "
			<div style='float:left; border:2px black solid; margin:10px 0 0 5px; padding:10px;'>
				<h2>Untuk Select</h2>
		";
		foreach($database as $data) {
			echo "$data[kol], <br>";
		}
		echo "
			</div>
		";
		
		
		echo "
			<div style='float:left; border:2px black solid; margin:10px 0 0 10px; padding:10px;'>
				<h2>Untuk TH</h2>
		";
		foreach($database as $data) {
			$kol = $data['kol'];
			$tipe = $data['tipe'];
			
			$cek__ = strpos($kol, '_');
			
			$explode = $kol;
			if($cek__ !== false) {
				$explode = explode('_', $kol);
				$explode = "$explode[0] $explode[1]";
			}
			
			$label = ucwords($explode);
			
			echo "< th>$label< /th> <br>";
		}
		echo "
			</div>
		";
		
		
		echo "
			<div style='float:left; border:2px black solid; margin:10px 0 0 10px; padding:10px;'>
				<h2>Untuk Td</h2>
		";
		foreach($database as $data) {
			echo "< td>\$row[$data[kol]]< /td> <br>";
		}
		echo "
			</div>
		";
		
		echo "
			<div style='float:left; border:2px black solid; margin:10px 0 0 5px; padding:10px;'>
				<h2>Untuk Array()</h2>
		";
		foreach($database as $data) {
			$kol = $data['kol'];
			$tipe = $data['tipe'];
			
			$cek__ = strpos($kol, '_');
			
			$explode = $kol;
			if($cek__ !== false) {
				$explode = explode('_', $kol);
				$explode = "$explode[0] $explode[1]";
			}
			
			$label = ucwords($explode);
			
			echo "\"$kol\"=>[\"label\"=>\"$label\", \"name\"=>\"$kol\", \"tipe\"=>\"$tipe\"], <br>";
		}
		echo "
			</div>
		";
	}
?>

