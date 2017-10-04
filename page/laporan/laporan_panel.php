<?php
	
	$jenisuser = $_SESSION['jenisuser'];
	$kode_kantor = $_SESSION["kode$jenisuser"];
	
	$klausa = '';
	$kodegi = '';
	
	$kodegi = !empty($_POST['kodegi']) && $_POST['kodegi'] != 'semua' ? " = $_POST[kodegi]" : '';
	$kodegi = !empty($_GET['kodegi']) && $_GET['kodegi'] != 'semua' ? " = $_GET[kodegi]" : '';
	
	$kodeapp = !empty($_POST['kodeapp']) && $_POST['kodeapp'] != 'semua' ? " = $_POST[kodeapp]" : '';
	$kodeapp = !empty($_GET['kodeapp']) && $_GET['kodeapp'] != 'semua' ? " = $_GET[kodeapp]" : '';
	
	
	$innerjoin = '';
	$klausa = "where";
	
	if($jenisuser == 'ki') {
		$innerjoin = "
			inner join master.gi 
				on master.gi.kodegi=apar.kode_kantor				
		";
		
		$klausa .= "
			kantor = 'app' AND
			kode_kantor $kodeapp OR
			kantor = 'gi' AND
			kode_kantor $kodegi
		";
	}
	$sql = "
		select 
			kode_panel 'id', 
			panel.id_merk,
			concat('Lantai ', lantai, ' / ', no_panel, ' / ', penempatan) 'panel',
			(select merk from merk where merk.id_merk = panel.id_merk) 'merk',
			no_panel, lantai, penempatan
		from panel 
		inner join merk 
			on panel.id_merk=merk.id_merk 
		where 
			kodegi = $kodegi AND kodeapp = $kodeapp AND
			s
		order by kode_panel desc 
	";
	
	//echo $sql;
	//var_dump($sql);
	$sql = mysql_query($sql);

?>

<div class="panel-body">
	<div class="table-responsive">
		<br />
		<table class="table table-striped table-bordered table-hover" id="datatabel">
			<thead>
				<tr>
					<th>No</th>
					<th>Panel</th>
					<th>Merk</th> 
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				while($row=mysql_fetch_array($sql)) {
					
					$sql_merk = "select merk from merk where id_merk = $row[id_merk]";
					$sql_merk = mysql_query($sql_merk);
					$row_merk = mysql_fetch_array($sql_merk);
			?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $row['panel']; ?></td>
						<td><?php echo $row_merk['merk']; ?></td>
					</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>