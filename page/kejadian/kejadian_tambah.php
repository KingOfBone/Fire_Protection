
<?php
	$kolom = [
		[
			"kode_sensor"=>["label"=>"Sensor", "name"=>"kode_sensor", "tipe"=>"int"], 
			"tgl_kejadian"=>["label"=>"Tgl Kejadian", "name"=>"tgl_kejadian", "tipe"=>"date"], 
			"keterangan_kejadian"=>["label"=>"Keterangan Kejadian", "name"=>"keterangan_kejadian", "tipe"=>"varchar"]							
		]
	];
	
	
	if(isset($_POST["submit"])) {
		unset($_POST["submit"]);
		
		$post = $_POST;
		
		
		
		foreach($post as $key=>$pos) {
			foreach($kolom as $kol) {
				if($kol[$key]['tipe'] == 'date') {
					$pos = explode('/', $pos);
					$pos = "$pos[2]/$pos[1]/$pos[0]";
				}
			}
			
			$post[$key] = mysql_real_escape_string($pos);
			$post[$key] = "'$post[$key]'";
		}
		
		
		
		
		$kolomnyah = array_keys($post);	
		$data = implode(', ', $post);		
		$kolomnyah = implode(', ', $kolomnyah);		
		
		$sql = "insert into kejadian ($kolomnyah) values($data)";
		mysql_query($sql);
		
		header("location:?kejadian_tambah&&pesan=berhasil");
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
                    <h2>Tambah <?php echo ucwords_kolom_table($nama_table); ?> </h2>
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
					<form id="validate-me-plz" name="form1" enctype="multipart/form-data" role="form" action="" method="post">
						
						<?php
							$i_gambar_dinamis = 1;
							$array_keys = array_keys($kolom);
							
							foreach($array_keys as $arke) {
						?>
								<div class='col-lg-6'>
									<?php 
										foreach($kolom[$arke] as $key=>$kol) { 
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
														if($kol['name'] == 'kode_sensor') {														
															$sql_sensor = "
																select 
																	kode_sensor 'id',
																	concat(no_sensor, ' / ', penempatan_sensor) 'value'
																from sensor 
																inner join panel 
																	on panel.kode_panel=sensor.kode_panel 
																where kodegi = $kodegi AND kodeapp = $kodeapp 
																order by kode_sensor asc 
															";
															//$sql_sensor = "select * from merk order by merk asc";
															$sql_sensor = mysql_query($sql_sensor);
															
															echo "<select name='$kol[name]' class='form-control'>";
															while($row_sensor = mysql_fetch_array($sql_sensor)) {
													?>
																<option value='<?php echo $row_sensor['id']; ?>'><?php echo $row_sensor['value']; ?></option>													
													<?php
															}
															echo "</select>";
														}
														else {
															if($kol['tipe'] == 'hidden') { 
													?>
																<input type="hidden" name="<?php echo $kol['name'] ?>" value="<?php echo $kol['value'] ?>"  />
													
													<?php 
															}
															if($kol['tipe'] == 'enum') {
																
																echo "<select name='$kol[name]' class='form-control'>";
																foreach($kol['value'] as $val) {
													?>
																	<option value='<?php echo $val; ?>'><?php echo $val; ?></option>";													
													<?php
																}
																echo "</select>";
													
															}
															else if($kol['tipe'] == 'int' || $kol['tipe'] == 'varchar') { 
													?>
																<input type="text" class="form-control" name="<?php echo $kol['name'] ?>" data-rule-required="true" />
													
													<?php 
															} else if($kol['tipe'] == 'date') { 
													?>
																<input  type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control datepicker" name="<?php echo $kol['name'] ?>"  />
													
													<?php 
															} else if($kol['tipe'] == 'gambar') { 
													?>
																<input type="file" class="form-control fileToUpload" id='gambar_dinamis_<?php echo $i_gambar_dinamis; ?>' name="<?php echo $kol['name'] ?>" />
																<img id="blah_<?php echo $i_gambar_dinamis; ?>" alt="" style='width:150px; height:150px;' class='rotateimg90' />
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
						
						
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<button type="submit" name="submit" id="submit" value="submit" class="btn btn-large btn-success">Simpan</button>
										<a href="?<?php echo $nama_table_kecil; ?>_lihat" class="btn btn-large btn-warning">Kembali</a>
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
