


<!-- Pick Day -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<script type="text/javascript" src="page/gangguan/triger.js"></script>


<div id="wrapper">
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Laporan</h2>
                    <hr />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Table laporan</div>
							<div class="panel-body">
								<div class='row'>
									<div class='col-lg-12'>
									<?php
										$nama_table = ucwords($_GET['laporan_unit_lihat']);
									?>
                                    <form id="validate-me-plz" name="form_akun" role="form" action="?laporan_unit_lihat=<?php echo $nama_table; ?>" method="post" >
										<?php
											$jenisuser = $_SESSION['jenisuser'];
									
											if($jenisuser != 'gi')
												echo "
												<div class='form-group'>
													<div class='row'>
												";
										?>
												<?php 
													function select_app() { 
												?>
													<div class="col-md-2">
														<label>APP</label>
													</div>
													<div class="col-md-3">
														<select name='kodeapp' onChange='cari_gi(this.value)' class="form-control">
															<?php
																$sql = "select * from master.app";
																$sql = mysql_query($sql);
																while($datatemp = mysql_fetch_array($sql)) {
																	echo "<option value='$datatemp[kodeapp]'>$datatemp[namaapp]</option>";
																}
															?>
														</select>
													</div>
											<?php 
												} 
												function select_gi() { ?>
													
													<div class="col-md-2">
														<label>GI</label>
													</div>
													<div class="col-md-3">
														<select name='kodegi' id='gi_unit' class="form-control">
															<option value='semua'>Semua</option>
															<?php
																//if($_SESSION['jenisuser'] == 'app') {
																	$sql = "
																		select * from master.gi 
																		inner join master.app
																			on master.app.kodeapp=master.gi.kodeapp
																		where 
																			master.gi.kodeapp = (
																				select master.app.kodeapp from master.app order by master.app.kodeapp asc limit 1
																			)
																		order by namagi asc
																	";
																	$sql = mysql_query($sql);
																	while($datatemp = mysql_fetch_array($sql)) {
																		echo "<option value='$datatemp[kodegi]'>$datatemp[namagi]</option>";
																	}
																//}
															?>
														</select>
													</div>
											<?php 
												}

												if($jenisuser == 'ki') {
													select_app();
													select_gi();
												}
												else if($jenisuser == 'app') {
													select_gi();
												}
											?>
											
										
											</div>
										</div>
										
										
										
										
										
										
										<div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
													<label>Pilih Periode Awal :</label>
												</div>
                                                <div class="col-md-3">
                                                    <input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control datepicker" name="tglawal" data-rule-required="true" data-msg-required="Mohon masukkan data tanggal daftar." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" placeholder="isikan kolom tanggal" value="<?php if(isset($_POST["cari"])){ echo $_POST["tglawal"]; } ?>" />
                                                </div>
												
												<div class="col-md-2">
													<label>Pilih Periode Akhir :</label>
												</div>
                                                <div class="col-md-3">
                                                    <input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control datepicker" name="tglakhir" data-rule-required="true" data-msg-required="Mohon masukkan data tanggal daftar." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" placeholder="isikan kolom tanggal" value="<?php if(isset($_POST["cari"])){ echo $_POST["tglakhir"]; } ?>" />
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-sm btn-success" name="cari" type="submit"> Cari</button>
                                                </div>
												
												<?php
													$kodeapp = !empty($_POST['kodeapp']) ? $_POST['kodeapp'] : $kodeapp;
													$kodegi = !empty($_POST['kodegi']) ? $_POST['kodegi'] : $kodegi;
													$tglawal = !empty($_POST['tglawal']) ? $_POST['tglawal'] : '';
													$tglakhir = !empty($_POST['tglakhir']) ? $_POST['tglakhir'] : '';	
												?>
												
                                                <!--
													tempat naro link cetak dan excel
												-->
											

											<?php 
												if($jenisuser != 'gi')
													echo "
															</div>
														</div>
													";
											?>
                                    </form>
									
									<div style='text-align:right; margin-right:1%;'>
										<a href="page/laporan/cetak.php?act=print&table=<?php echo $_GET['laporan_unit_lihat']; ?>&tglawal=<?php echo $tglawal; ?>&tglakhir=<?php echo $tglakhir; ?>&kodeapp=<?php echo $kodeapp; ?>&kodegi=<?php echo $kodegi; ?>" target="_blank"><img src="images/print.png" title="cetak dokumen" /></a>
										<a href="page/laporan/cetak.php?act=excel&table=<?php echo $_GET['laporan_unit_lihat']; ?>&tglawal=<?php echo $tglawal; ?>&tglakhir=<?php echo $tglakhir; ?>&kodeapp=<?php echo $kodeapp; ?>&kodegi=<?php echo $kodegi; ?>"><img src="images/excel.png" /></a>
									</div>
                                </div>
                            </div>
                            <?php 
								
								
								if(isset($_POST["cari"])) {
									$key     = (ubahtgl($_POST['tglawal'])) ? ubahtgl($_POST['tglawal']) : ubahtgl($_GET['tglawal']);
									$key2     = (ubahtgl($_POST['tglakhir'])) ? ubahtgl($_POST['tglakhir']) : ubahtgl($_GET['tglakhir']);
									
									//echo "keynya=$key";
									//echo "nama_table = $nama_table";
									
									if($nama_table == 'Pengisian') {
										$_SESSION['tgl'] = ['tglawal'=>$key, 'tglakhir'=>$key2];
									}
									
									$daftar_dir['pemeliharaan'] = ['pemeliharaan'];
									//echo "laporan_".$_GET['laporan_unit_lihat'].".php";
									
									include("laporan_".$_GET['laporan_unit_lihat'].".php");
								}/* 
								else if($nama_table == 'Pengisian' && !empty($_GET['idp'])){
									//echo "laporan_".$_GET['laporan_unit_lihat'].".php";
									//echo "masuk ajah";
									include("laporan_".$_GET['laporan_unit_lihat']."_detail.php");
								} */
							?>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>
    </div>
</div>




<?php if($_SESSION['jenisuser'] == 'ki') { ?>
	<script>
		function cari_gi(kodeapp) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {		
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("gi_unit").innerHTML = this.responseText;
				}
			};
			
			xhttp.open("POST", "page/apar_unit/apar_unit_cari_gi.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("kodeapp="+kodeapp);
		}
	</script>
<?php } ?>



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
