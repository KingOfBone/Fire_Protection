<?php
	$sql[] = "select count(*) 'BaseCamp' from BaseCamp";
	$sql[] = "select count(*) 'GI' from GI";
	$sql[] = "select count(*) 'Lantai' from Lantai";
	$sql[] = "select count(*) 'Apar' from Apar";

	$multiple_query = multiple_query($sql);
?>

<div id="wrapper">
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Input Monitoring APAR</h2>
                    <hr />
                </div>
            </div>
            <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-9">
                    <?php if(isset($_GET["sukseshapus"])) {?>
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
                        <div class="alert alert-success" id="alertupload">Data berhasil Ditambah,
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                        </div>
                    <?php } ?>
                </div>

				<!--
                <div class="col-md-3">
                    <a href="?tambah-gangguan" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a> <a href="?lapgangguan" class="btn btn-sm btn-danger"><i class="fa fa-list-alt"> </i> Laporan</a>
                    <br /><br />
                </div>
				-->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Table Input Data Monitoring APAR</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="datatabel">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">No</th>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">Kategori</th>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">Jumlah</th>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">Keterangan</th>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">Aksi</th>
                                        </tr>                                        
                                    </thead>
                                    <tbody>
                                        <?php 
											if(count($multiple_query) > 0) {
												$no=1;
												foreach($multiple_query as $mq) {
													$nama_table = array_keys($mq[0]);
													$nama_table = $nama_table[1];
										?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nama_table;?></td>
														<td>Aktif</td>														
														<td><?php echo $mq[0][$nama_table];?></td>
														
														<td class="text-center">
															<a href="?input_lihat=<?php echo $nama_table; ?>" type="button"><i class="fa fa-eye fa-2x"></i></a>
															<a href="#" id="input_delete=<?php echo $nama_table; ?>" class="delete">
																<i class="fa fa-trash-o fa-2x"></i>
															</a>
														</td>
													</tr>
                                        <?php 
													$no++;
												}
											} else { 
										?>
												<tr><td colspan="8" class="text-center"><i>Tabel data kosong</i></td></tr>
                                        <?php 
											} 
										?>
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
    $(document).ready( function () {
        $('#datatabel').dataTable( {
            "paging":   true,
            "ordering": false,
            "bInfo": false,
            "dom": '<"pull-left"f><"pull-right"l>tip'
        });
    });
</script>
