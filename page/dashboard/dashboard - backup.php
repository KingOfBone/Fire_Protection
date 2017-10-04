<?php
	$nama_table = 'Apar';
	
	$kolom_table = information_schema('Dashboard');
	
	
	$pk = ambil_pk($nama_table);
	//var_dump($pk);
	
	if(isset($_GET['input_delete']))
		delete($nama_table, $pk, $_GET['id']);
	
	$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;;
	
	$sql = kumpulan_query_tampil_dibaris_awal($pk, 'Dashboard');
	$sql = mysql_query($sql);
	
?>

<div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Data <?php echo ucwords_kolom_table($nama_table); ?></h2>
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
                <div class="col-md-3">
                    <a href="?<?php echo $nama_table_kecil; ?>_tambah" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a>
                    <br /><br />
                </div>
				
           </div>
           <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table <?php echo ucwords_kolom_table($nama_table); ?>
                        </div>
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
                    						<th width="10%">Aksi</th>
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
														var_dump($kolom_table); die();
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
<script>
 $(document).on('click','.detail',function(e){
    e.preventDefault();
    $("#myModal1").modal('show');
    $.post('page/apar/apar_modal.php',
    {
		id:$(this).attr('data-id'), 
		nama_table:$(this).attr('data-nama_table'),
		objek:$(this).attr('data-objek')
	},
    function(html){
    $(".modal-body").html(html);
    }
    );
 });
 
 $(document).on('click','.detail_peta',function(e){
    e.preventDefault();
    $("#myModal2").modal('show');
    $.post('page/apar/apar_modal_peta.php',
    {
		id:$(this).attr('data-id'), 
		nama_table:$(this).attr('data-nama_table'),
		objek:$(this).attr('data-objek2')
	},
    function(html){
    $(".modal-body2").html(html);
    }
    );
 });
</script>


<div id="myModal1" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 0;">
      <!-- dialog body -->
       <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detail Data <?php echo $nama_table; ?></h4>
       </div>
      <div class="modal-body"></div>
      <!-- dialog buttons -->
      <div class="modal-footer">
      <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Tutup</button>
    </div>
  </div>
</div>
</div>


<div id="myModal2" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 0;">
      <!-- dialog body -->
       <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Peta Apar</h4>
       </div>
      <div class="modal-body2"></div>
      <!-- dialog buttons -->
      <div class="modal-footer">
      <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">Tutup</button>
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
    $(document).ready( function () {
      $('#datatabel').dataTable( {
        "paging":   true,
        "ordering": false,
        "bInfo": false,
        "dom": '<"pull-left"f><"pull-right"l>tip'
      } );
    } );

    </script>
