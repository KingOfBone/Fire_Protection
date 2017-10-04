<?php
	$nama_table = 'Apar';
	
	$pk = ambil_pk($nama_table);
	//var_dump($pk);
	
	if(isset($_GET['input_delete']))
		delete($nama_table, $pk, $_GET['id']);
	
	$sqlx = kumpulan_query_tampil_dibaris_awal($pk, 'Dashboard');
	
?>

<div id="wrapper">
	<!-- /. NAV SIDE  -->
	<div id="page-wrapper" >
		<div id="page-inner">
			<div class="row">
				<div class="col-md-12">
					<h2>Dashboard Aplikasi Apar</h2>
					<hr />
				</div>
			</div>
			<!-- /. ROW  -->
	   <div class="row">
			<div class="col-md-10">
				<?php if(isset($_GET["sukseshapus"])){?>
					 <div class="alert alert-success">Data Berhasil Di Hapus...
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
					 </div>
					 <?php }else if(isset($_GET["suksesedit"])){ ?>
					 <div class="alert alert-success">Data Berhasil Di Ubah...
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
					 </div>
					 <?php }else if(isset($_GET["suksesbalaskomen"])){ ?>
					 <div class="alert alert-success">Komentar Berhasil Di balas...
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
					 </div>
					 <?php }else if(isset($_GET["suksestambah"])){?>
					 <div class="alert alert-success" id="alertupload">Data  berhasil Ditambah,
					 <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
					 </div>
					<?php } ?>
			</div>
			
			<!--
			<div class="col-md-3">
				<a href="?<?php echo $nama_table_kecil; ?>_tambah" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
				<br /><br />
			</div>
			-->				
	   </div>
	   
	   <div class="row">					
			<div class="col-md-6">
				<!-- Advanced Tables -->
				<div class="panel panel-default">
					<div class="panel-heading">
						 Apar Yang Akan Kadaluarsa 3 Bulan Depan
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<br />
							<table class="table table-striped table-bordered table-hover" id="datatabel1">
								<thead>
									<tr>
										<th width="4%">No</th>
										<th width="4%">No Apar</th>
										<th width="4%">Penempatan</th>
										<th width="4%">Unit</th>
										<!--
										<th width="10%">Aksi</th>
										-->
									</tr>
								</thead>
								<tbody>
								<?php
									$no=1;
									$sql = mysql_query($sqlx['3bulan']);
									while($row=mysql_fetch_array($sql)) {
								?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $row['no_apar']; ?></td>
											<td><?php echo $row['penempatan']; ?></td>
											<td><?php echo $row['unit']; ?></td>
											
											<!--
											<td class="center">
												<a href="#" class="detail" data-id="<?php echo $row['id']; ?>" data-nama_table="<?php echo $nama_table; ?>" data-objek="apar" role="button" data-toggle="modal">
													<i class="glyphicon glyphicon-zoom-in fa-2x"></i>
												</a>
												<a href="#" class="detail_peta" data-id="<?php echo $row['id']; ?>" data-nama_table="<?php echo $nama_table; ?>" data-objek2="lokasi" role="button" data-toggle="modal">
													<i class="fa fa-map-marker fa-2x"></i>
												</a>
												<a href="?<?php echo $nama_table_kecil; ?>_update=<?php echo $nama_table_kecil; ?>&&id=<?php echo $row['id']; ?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
												 <a href="#" id="mau_delete=<?php echo "$nama_table_kecil,$pk,$row[id],".$nama_table_kecil."_lihat"; ?>" class="delete">
													<i class="fa fa-trash-o fa-2x"></i>
												 </a>
											</td>
											-->
										</tr>
									<?php $no++; } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!--End Advanced Tables -->
			</div>
			<div class="col-md-6">
				<!-- Advanced Tables -->
				<div class="panel panel-default">
					<div class="panel-heading">
						 Table <?php echo ucwords_kolom_table($nama_table); ?> Kadaluarsa 3 bulan
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<br />
							<table class="table table-striped table-bordered table-hover" id="datatabel2">
								<thead>
									<tr>
										<th width="4%">No</th>
										<th width="4%">APP</th>
										<th width="4%">Jumlah APAR</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no=1;
									
									$sql = mysql_query($sqlx['cari_kodeapp']);
									while($row=mysql_fetch_array($sql)) {
										$sql2 = "
											select count(*) 'jml' from `master`.app 
											inner join `master`.gi
												on `master`.app.kodeapp=`master`.gi.kodeapp
											inner join apar.apar
												on apar.apar.kode_gi=`master`.gi.kodegi
											where `master`.app.kodeapp = $row[kodeapp]
										";
										
										$sql2 = mysql_query($sql2);
										$row2 = mysql_fetch_array($sql2);
								?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $row['namaapp']; ?></td>
											<td><?php echo $row2['jml']; ?></td>
											
											<!--
											<td class="center">
												<a href="#" class="detail" data-id="<?php echo $row['id']; ?>" data-nama_table="<?php echo $nama_table; ?>" data-objek="apar" role="button" data-toggle="modal">
													<i class="glyphicon glyphicon-zoom-in fa-2x"></i>
												</a>
												<a href="#" class="detail_peta" data-id="<?php echo $row['id']; ?>" data-nama_table="<?php echo $nama_table; ?>" data-objek2="lokasi" role="button" data-toggle="modal">
													<i class="fa fa-map-marker fa-2x"></i>
												</a>
												<a href="?<?php echo $nama_table_kecil; ?>_update=<?php echo $nama_table_kecil; ?>&&id=<?php echo $row['id']; ?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
												 <a href="#" id="mau_delete=<?php echo "$nama_table_kecil,$pk,$row[id],".$nama_table_kecil."_lihat"; ?>" class="delete">
													<i class="fa fa-trash-o fa-2x"></i>
												 </a>
											</td>
											-->
										</tr>
									<?php $no++; } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!--End Advanced Tables -->
			</div>
		</div>

	</div>
   </div>
</div>


<!-- confirm dell -->
<script src="assets/confirmdell/js/script.js"></script>

<!-- DATA TABLE SCRIPTS -->
    <script src="assets/datatables/jquery.dataTables.js"></script>
    <script src="assets/datatables/dataTables.bootstrap.js"></script>
    <script>
    /* $(document).ready( function () {
      $('#datatabel1').dataTable( {
        "paging":   true,
        "ordering": false,
        "bInfo": false,
        "dom": '<"pull-left"f><"pull-right"l>tip'
      } );
	  
	  $('#datatabel2').dataTable( {
        "paging":   true,
        "ordering": false,
        "bInfo": false,
        "dom": '<"pull-left"f><"pull-right"l>tip'
      } );
    } ); */

    </script>
