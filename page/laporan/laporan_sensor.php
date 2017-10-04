<?php
	//echo "nama_table = $nama_table";
	$kolom_table = information_schema($nama_table);

	$pk = ambil_pk($nama_table);
	
	$jenisuser = $_SESSION['jenisuser'];
	$kode_kantor = $_SESSION["kode$jenisuser"];
	
	//$sql = kumpulan_query_tampil_dibaris_awal($pk, $nama_table, $_POST);
	
	$tglawal = !empty($_POST['tglawal']) ? $_POST['tglawal'] : $_GET['tglawal'];
	$tglakhir = !empty($_POST['tglakhir']) ? $_POST['tglakhir'] : $_GET['tglakhir'];
	
	$sql = "
		SELECT
		apar.pengisian.kode_pengisian,
		apar.apar.id_apar,
		apar.pengisian.tgl_pengisian_terakhir,
		apar.pengisian.tgl_pengisian_kembali,
		apar.pengisian.catatan,
		apar.pemeliharaan.indikator,
		apar.pemeliharaan.tgl_pemeliharaan,
		apar.apar.id_apar 'id', Apar.id_apar 'fk',
		`master`.gi.namagi,
		`master`.app.namaapp
		FROM
		apar.pemeliharaan
		INNER JOIN apar.pengisian ON apar.pengisian.kode_pengisian = apar.pemeliharaan.kode_pengisian
		INNER JOIN apar.apar ON apar.apar.id_apar = apar.pengisian.kode_apar
		INNER JOIN `master`.gi ON apar.apar.kode_kantor = `master`.gi.kodegi
		INNER JOIN `master`.app ON `master`.app.kodeapp = `master`.gi.kodeapp
		where 
			apar.pengisian.tgl_pengisian_terakhir between '".ubahtgl($tglawal)."' AND '".ubahtgl($tglakhir)."' AND
			kantor = '$jenisuser' AND kode_kantor = $kode_kantor
	";
	//var_dump($sql);
	$sql = mysql_query($sql);

?>

<div class="panel-body">
	<div class="table-responsive">
		<br />
		<table class="table table-striped table-bordered table-hover" id="datatabel">
			<thead>
				<tr>
					<th width="4%">No</th>
					<?php
						tampil_kolom_table($kolom_table);
					?>
				</tr>
			</thead>
			<tbody>
			<?php
				$no=1;
				while($row=mysql_fetch_array($sql)) {											
			?>
					<tr>
						<td><?php echo $no; ?></td>
						<?php
							$i=0;
							foreach($kolom_table as $kol) {
								$cek_kolom = strpos($kol['Komen'], "penting");
								
								if($cek_kolom !== false) {
									$cek_fk = strpos($kol['Komen'], "fk");
									
									if($cek_fk !== false) {
										$explode = explode('___', $row['fk']);
										$kolom_explode = $explode[$i];
										
										$i++;
									}
									
									$kolom_explode = isset($kolom_explode) ? $kolom_explode : $kol['Kolom'];
									
									echo '<td>'. tampil_kolom_isitable('lihat', $kolom_explode, $kol['Tipe'], $nama_table, $row, $cek_fk) .'</td>';																
									
									$kolom_explode = null;
								}
							}
						?>
						
						<!--
						<td class="center">
							<a href="?laporan_lihat=pengisian&&idp=<?php echo $row['id']; ?>" class="detail" data-id="<?php echo $row['id']; ?>" data-nama_table="<?php echo $nama_table; ?>" data-objek="apar" role="button" data-toggle="modal">
								<i class="fa fa-print fa-2x"></i>
							</a>
						</td>
						-->
					</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>