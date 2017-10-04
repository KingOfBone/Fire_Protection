<?php
	$jenisuser = $_SESSION['jenisuser'];
	
	
	$tglawal = !empty($_POST['tglawal']) ? $_POST['tglawal'] : $_GET['tglawal'];
	$tglakhir = !empty($_POST['tglakhir']) ? $_POST['tglakhir'] : $_GET['tglakhir'];
	
	
	$klausa = '';
	if(!empty($_POST['kodegi']))
		$klausa = $_POST['kodegi'] == 'semua' ? "" : " kodegi = $_POST[kodegi] ";
	else
		$klausa = "kodegi = $kodegi ";
	
	
	
	$klausa = !empty($klausa) ? " $klausa AND " : $klausa;
	
	if(!empty($_POST['kodeapp']))
		$klausa .= $_POST['kodeapp'] == 'semua' ? "" : " kodeapp = $_POST[kodeapp] ";
	else
		$klausa .= " kodeapp = $kodeapp ";
	
	$klausa = !empty($klausa) ? "$klausa AND " : $klausa;
	
	$sql = "
		select			
			kode_kejadian 'id', 
			concat(no_sensor, ' / ', penempatan_sensor) 'sensor', 
			tgl_kejadian, 
			keterangan_kejadian
		from kejadian 
		inner join sensor 
			on sensor.kode_sensor=kejadian.kode_sensor 
		inner join panel 
			on panel.kode_panel=sensor.kode_panel 
		where 
			$klausa
			tgl_kejadian between '".ubahtgl($tglawal)."' AND '".ubahtgl($tglakhir)."'			
	";
	
	//echo $sql;
	$sql = mysql_query($sql);

?>

<div class="panel-body">
	<div class="table-responsive">
		<br />
		<table class="table table-striped table-bordered table-hover" id="datatabel">
			<thead>
				<tr>
					<th>No</th>
					<th>Sensor</th> 
					<th>Tgl Kejadian</th> 
					<th>Keterangan Kejadian</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				while($row = mysql_fetch_array($sql)) {
					
					echo "
						<tr>													
							<td>$no</td> 
							<td>$row[sensor]</td> 
							<td>$row[tgl_kejadian]</td> 
							<td>$row[keterangan_kejadian]</td>
						</tr>
					";
					$no++; 
				}
			?>
			</tbody>
		</table>
	</div>
</div>