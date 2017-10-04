<?php
	$nama_table = strtoupper($_GET['input_lihat']);
	$id = strtoupper($_GET['id']);
	
	$kolom_table = information_schema($nama_table);
	
	$pk = ambil_pk($nama_table);
	
	$sql = "select * from $nama_table where $pk = $id";
	$sql = mysql_query($sql);
	$row = mysql_fetch_array($sql);
	
	//var_dump($row);
?>

<div id="wrapper">
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Input Monitoring APAR - <?php echo "$nama_table - $row[nama]"; ?> </h2>
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
                <div style='width:350px; text-align:right; float:right;' class="col-md-2">
                    <a href="?tambah-gangguan" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-plus"></i>Tambah Data</a> 
					<a href="?lapgangguan" class="btn btn-sm btn-danger"><i class="fa fa-list-alt"> </i> Laporan</a>
					<a href="?input" class="btn btn-sm btn-danger"><i class="fa fa-backward"> </i> Kembali</a>
                    <br /><br />
                </div>
				-->
				
				<div style='width:350px; text-align:right; float:right;' class="col-md-2">
                    <a href="?input_lihat=<?php echo $nama_table; ?>" class="btn btn-sm btn-danger"><i class="fa fa-backward"> </i> Kembali</a>
                    <br /><br />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Table Input Data Monitoring APAR - <?php echo "$nama_table - $row[nama]"; ?></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="datatabel">
                                    <thead>
                                        <tr>											
                                            <?php
												tampil_kolom_table($kolom_table);
											?>
											<th style="text-align:center; vertical-align: middle;" rowspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<tr>
											<?php
												foreach($kolom_table as $kol) {
													if($kol['Komen'] == 'penting') {
														tampil_kolom_isitable('lihat', $kol['Kolom'], $kol['Tipe'], $nama_table, $row);
													}
												}
											?>
												
											<td class="text-center">
												<a href="?input_update=<?php echo $nama_table; ?>&&id=<?php echo $id; ?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
												<a href="#" id="input_delete=<?php echo $nama_table; ?>" class="delete">
													<i class="fa fa-trash-o fa-2x"></i>
												</a>
											</td>
										</tr>
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
