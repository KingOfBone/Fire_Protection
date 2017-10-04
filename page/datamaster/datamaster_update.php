<?php
	//$nama_table = ucwords($_GET['input_update']);
	$id = strtoupper($_GET['id']);
	
	$kolom_table = information_schema($nama_table);	
	$pk = ambil_pk($nama_table);
	
	$table_array = ['APAR', 'LOKASI'];
	
	
	if(isset($_POST["submit"])){
		$FILES = in_array($nama_table, $table_array) ? $_FILES : null;
		
		update($nama_table, $id, $pk, "?".$foldernyah."_update=$nama_table&&id=$id", $_POST, $kolom_table, $FILES);
	}
	
	$sql = "select * from $nama_table where $pk = $id";
	$sql = mysql_query($sql);
	$row = mysql_fetch_array($sql);
?>
 <script type="text/javascript">
    function isNumberKeyTgl(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
    //     if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
      function isNumberKey(evt) {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
      </script>
      <script type="text/javascript" src="assets/js/bootstrap-filestyle.js"></script>
      <link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Ubah <?php echo ucwords_kolom_table($nama_table); ?></h2>
                    </div>
                </div>
				<!-- /. ROW  -->
	<hr />
	
	<?php if(!empty($_GET["pesan"]) && $_GET["pesan"] == 'berhasil'){?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success">Data berhasil ubah
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
				</div>
			</div>
		</div>
	<?php } ?>
	
	
	
	<!-- content -->
	<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Ubah <?php echo ucwords_kolom_table($nama_table); ?>
            </div>
            <div class="panel-body">
                <div class="row">
					<form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="#" method="post">
						<div class="col-lg-6">
							<?php
								foreach($kolom_table as $key=>$kol) {
									$cek_primary = strpos($kol['Komen'], 'primary');									
									$cek_fk = strpos($kol['Komen'], 'fk');									
									
									$hidden = $cek_primary !== false ? "hidden" : null;
									
									$kolom = ucwords_kolom_table($kol['Kolom']);
									$kolom2 = strtolower($kol['Kolom']);
									
									if($cek_fk !== false) {
										
										$q = array();
										if($nama_table == 'APAR') {
											$q = [
												"select id_merk 'id', merk 'val' from Merk",
												"select id_jns_api 'id', jenis_api 'val' from Jenis_Api"
											];
										}
										else if($nama_table == 'LOKASI') {
											$q = [
												"select kodegi 'id', namagi 'val' from master.GI",
												"select id_apar 'id', concat(tipe, ' - ', model) 'val' from APAR"
											];
										}
										else if($nama_table == 'MAINTENANCE') {
											$q = [
												"select id_lks 'id', concat(lantai, ' - ', ruang) 'val' from Lokasi"
											];
										}
										
										$sql = mysql_query($q[($key-1)]);
										//echo $q[($key-1)];
							?>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label <?php echo $hidden; ?>><?php echo $kolom; ?></label></div>
												<div class="col-md-5">
													<select name='<?php echo $kolom2; ?>' class="form-control">
														<?php
															while($datatemp = mysql_fetch_array($sql)) {
																if($row[$kol['Kolom']] == $datatemp['id'])
																	echo "<option selected value='$datatemp[id]'>$datatemp[val]</option>";
																else	
																	echo "<option value='$datatemp[id]'>$datatemp[val]</option>";
															}
														?>
													</select>
												</div>
											</div>
										</div>
							<?php
									}
									else {
										if($cek_primary !== false)
											echo "<input type='hidden' name='$kolom2' value='".$row[$kol['Kolom']]."' />";
										else {											
											$kolom = $kol['Kolom'];				
											$kolom = label_khusus($kolom);
											
											
							?>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>
															<?php echo $kolom; ?>
														</label>
													</div>
													<div class="col-md-5">
														<?php if($kol['Tipe'] == 'datetime') { ?>
															<input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datepicker" name="<?php echo $kolom2; ?>" value="<?php if($row[$kol['Kolom']]=="0000-00-00"){}else{ echo format_tgl($row[$kol['Kolom']]); } ?>" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl Oprs." placeholder="masukkan Tgl Oprs" />
														<?php } else if($kol['Komen'] == 'gambar') { ?>
															<input type="file" class="form-control" name="<?php echo $kolom2; ?>" value="<?php echo $row[$kol['Kolom']]; ?>" />
															<input type="hidden" name="<?php echo $kolom2.'_cadangan'; ?>" value="<?php echo $row[$kol['Kolom']]; ?>" />
														<?php } else { ?>
															<input type="text" class="form-control" name="<?php echo $kolom2; ?>" value="<?php echo $row[$kol['Kolom']]; ?>" data-rule-required="true" />
														<?php } ?>
													</div>
												</div>
											</div>
							<?php									
										}
									}
								}
							?>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-8">
									<button type="submit" name="submit" id="submit" value="submit" class="btn btn-large btn-success">Simpan</button>
									<a href="?<?php echo $foldernyah; ?>_lihat=<?php echo $nama_table; ?>" class="btn btn-large btn-warning">Kembali</a>
								</div>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementByClass('datepicker'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2500, 12, 31),
        yearRange: [1960, 2500],
        format: 'DD/MM/YYYY'
    });
</script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker2'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2500, 12, 31),
        yearRange: [1960, 2500],
        format: 'DD/MM/YYYY'
    });
</script>

<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">
$('#fileToUpload').filestyle();
 $('#fileToUpload').change(function(){
      var file = $('#fileToUpload').val();
      var exts = ['jpg','jpeg'];
      if ( file ) {
        var get_ext = file.split('.');
        get_ext = get_ext.reverse();
        if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
          return true;
        } else {
          alert('Hanya boleh jpg ');
          $('#fileToUpload').filestyle('clear');
        }
      }

    });

$('#validate-me-plz').validate({
      rules: {
        field: {
          required: true,
          date: true
        },
        alamat: {
                required: true
                }
        },
        messages: {
            alamat: {
            required: "Mohon masukkan data alamat"
                }
            }

    });
</script>
