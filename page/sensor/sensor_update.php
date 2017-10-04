
<?php
	$id = $_GET['id'];
	
	if(isset($_POST["submit"])) {
		unset($_POST["submit"]);
		
		$files = $_FILES;
		$post = $_POST;
		
		
		foreach($files as $key=>$f) {
			if(!empty($f['name'])) {
				$lokasi = $key == 'gambar_sensor' ? "Sensor" : "Lokasi_Sensor";
				
				$sql = "select kode_sensor from sensor order by kode_sensor desc limit 1";
				$hasil = mysql_query($sql);
				
				if(mysql_num_rows($hasil) > 0) {
					$row = mysql_fetch_array($hasil);
					$kode_sensor = $row['kode_sensor'];
				}
				else
					$kode_sensor = 1;
				
				
				$filename = $f["name"];
				$extension = end(explode(".", $filename));
				$newfilename = $lokasi."-$jenisuser-$nama_kantor-$post[no_sensor]-$post[penempatan_sensor]-$kode_sensor".".".$extension;

				$post[$key] = "$newfilename";
				
				$lokasi = "images/$lokasi/$newfilename";
				
				move_uploaded_file($f['tmp_name'], "$lokasi");				
			}
			else {
				$post[$key] = $post[$key."_cadangan"];
			}
			
			unset($post[$key."_cadangan"]);
		}
		
		foreach($post as $key=>$pos) {
			$post[$key] = mysql_real_escape_string($pos);
			$post[$key] = "$post[$key]";
		}
		
		
		$set = count($post) > 0 ? implode(', ', array_map(
			function ($v, $k) {				
				if(is_array($v)){
					return $k.'[]='.implode('&'.$k.'[]=', $v);
				}else{
					if($v != 'now()')
						return $k."='".$v."'";
					else
						return $k."=".$v."";					
				}
			}, 
			$post, 
			array_keys($post)
		)) : false;
		
		
		
		$sql = "update sensor set $set where kode_sensor = $id";
		mysql_query($sql);
		
		header("location:?sensor_update&&id=$id&&pesan=berhasil");
		die();
	}
?>



<link rel="stylesheet" href="script/dhtmlwindow.css" type="text/css" />
<script type="text/javascript" src="script/dhtmlwindow_fol.js"></script>
<link rel="stylesheet" href="librari/stylesuggest.css" type="text/css" />

<!-- Pick Day -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<script type="text/javascript" src="page/gangguan/triger.js"></script>

<div id="wrapper">
    <!-- /. NAV SIDE  -->
   <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Ubah <?php echo ucwords_kolom_table($nama_table); ?> </h2>
                </div>
            </div>
			<!-- /. ROW  -->
			<hr />
			
			
			<?php if(!empty($_GET["pesan"]) && $_GET["pesan"] == 'berhasil'){?>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-success">Data berhasil ditambah
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
						</div>
					</div>
				</div>
            <?php } ?>
			
			
			<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Tambah <?php echo ucwords_kolom_table($nama_table); ?>
            </div>
            <div class="panel-body">
                <div class="row">
					<?php
						$kolom = [
							[
								"no_sensor"=>["label"=>"No Sensor", "name"=>"no_sensor", "tipe"=>"int"], 
								"kode_panel"=>["label"=>"Panel", "name"=>"kode_panel", "tipe"=>"int"], 
								"gambar_sensor"=>["label"=>"Gambar Sensor", "name"=>"gambar_sensor", "tipe"=>"gambar"]
							],
							[
								"penempatan_sensor"=>["label"=>"Penempatan Sensor", "name"=>"penempatan_sensor", "tipe"=>"varchar"],
								"kondisi"=>["label"=>"Kondisi", "name"=>"kondisi", "tipe"=>"enum", "value"=>["Baik", "Kadaluarsa"]],
								"lokasi_sensor"=>["label"=>"Lokasi Sensor", "name"=>"lokasi_sensor", "tipe"=>"gambar"]
							],
							[
								"update_by"=>["label"=>"update_by", "name"=>"update_by", "tipe"=>"hidden", "value"=>$kodelogin],
								"tgl_update"=>["label"=>"tgl_update", "name"=>"tgl_update", "tipe"=>"hidden", "value"=>"now()"]
							]
						];
						
						$array_keys = array_keys($kolom);
						
						$sql = "SELECT * from sensor WHERE kode_sensor = '$id'";
	
						$sqldetail = mysql_query($sql) or die (mysql_error());
						$row = mysql_fetch_array($sqldetail);
						
						$i_gambar_dinamis = 1;
					?>
					<form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
						
						<?php
							foreach($array_keys as $kol_name) {
						?>
								<div class='col-lg-6'>
									<?php 
										foreach($kolom[$kol_name] as $key=>$kol) { 
										
											$value = $kol['tipe'] == 'hidden' ? $kol['value'] : $row[$kol['name']];
									?>
										<div class="form-group">
											<div class="row">
												<?php
													if($kol['tipe'] != 'hidden') { 
												?>												
												<div class="col-md-4">
													<label><?php echo $kol['label']; ?></label>
												</div>
												<?php
													}
												?>
												<div class="col-md-5">
													<?php 
														if($kol['name'] == 'kode_panel') {
															$sql_panel = "select concat('Lantai ', lantai, ' / ', no_panel, ' / ', penempatan) 'panel', kode_panel from panel order by kode_panel asc";
															$sql_panel = mysql_query($sql_panel);
															
															echo "<select name='$kol[name]' class='form-control'>";
															while($row_panel = mysql_fetch_array($sql_panel)) {
																$selected = $row['kode_panel'] == $row_panel['kode_panel'] ? "selected" : "";
																
																echo "<option $selected value='$row_panel[kode_panel]'>$row_panel[panel]</option>";
															}
															echo "</select>";
														}
														else {
															if($kol['tipe'] == 'hidden') {
													?>
																<input type="hidden" name="<?php echo $kol['name'] ?>" value="<?php echo $value ?>"  />
													
													<?php 
															}
															if($kol['tipe'] == 'enum') {
																
																echo "<select name='$kol[name]' class='form-control'>";
																foreach($kol['value'] as $val) {
																	$selected = $value == $val ? "selected" : "";
													?>
																	<option <?php echo $selected; ?> value='<?php echo $val; ?>'><?php echo $val; ?></option>";													
													<?php
																}
																echo "</select>";
													
															}
															else if($kol['tipe'] == 'int' || $kol['tipe'] == 'varchar') { 
													?>
																<input type="text" class="form-control" name="<?php echo $kol['name'] ?>" data-rule-required="true" value="<?php echo $value ?>" />
													
													<?php 
															} else if($kol['tipe'] == 'date') { 
													?>
																<input  type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control datepicker" name="<?php echo $kol['name'] ?>" value="<?php echo $value ?>"  />
													
													<?php 
															} else if($kol['tipe'] == 'gambar') { 
																$src = $kol_name == 'gambar_panel' ? "Sensor" : "Lokasi_Sensor";
																$src = "images/$src/$value";
													?>
																<input type="hidden" name="<?php echo $kol['name'] ?>_cadangan" value="<?php echo $value ?>" />
																<input type="file" class="form-control fileToUpload" id='gambar_dinamis_<?php echo $i_gambar_dinamis; ?>' name="<?php echo $kol['name'] ?>" value="<?php echo $value ?>" />
																<img src="<?php echo $src; ?>" id="blah_<?php echo $i_gambar_dinamis; ?>" alt="" style='width:150px; height:150px;' class='rotateimg90' />
													<?php 
																$i_gambar_dinamis++; 
															} 
														} 
													?>
													
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
						<?php } ?>
						
						<div class='col-lg-6'>
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<button type="submit" name="submit" id="submit" value="submit" class="btn btn-large btn-success">Ubah</button>
										<a href="?<?php echo $nama_table_kecil; ?>_lihat" class="btn btn-large btn-warning">Kembali</a>
									</div>
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
	</div>
</div>

<!--datepicker pikaday-->
<!--
<script src="assets/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script>
    $('.mulai').datetimepicker({
		dayOfWeekStart : 1,
		lang:'en',
		disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
		startDate:	'2017/01/05'
	});

	$('#normal1').datetimepicker({
	dayOfWeekStart : 1,
	lang:'en',
	disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
	startDate:	'2017/01/05'
	});
</script>
-->






<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
    var datepicker_class = document.getElementsByClassName('datepicker');
    var datepicker_length = datepicker_class.length;
	
	for(var i=0; i<datepicker_length; i++) {
		var picker = new Pikaday({
			field: datepicker_class[i],
			firstDay: 1,
			minDate: new Date(1960, 0, 1),
			maxDate: new Date(2500, 12, 31),
			yearRange: [1960, 2500],
			format: 'DD/MM/YYYY'
		});
	}
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">
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

    $('#gambar_dinamis_1').filestyle();
    $('#gambar_dinamis_1').change(function(){
        var file = $('#gambar_dinamis_1').val();
        var exts = ['jpg','jpeg'];
        if ( file ) {
            var get_ext = file.split('.');
            get_ext = get_ext.reverse();
            if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
                return true;
            }
            else
            {
                alert('Hanya boleh jpg ');
                $('#gambar_dinamis_1').filestyle('clear');
            }
        }
    });
</script>
