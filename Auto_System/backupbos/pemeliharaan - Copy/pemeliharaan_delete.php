<?php
include "config/koneksi.php";

if(isset($_POST["simpan"])){
    $number      = $_POST["number"];
    for($i=1;$i<=$number;$i++){
        $gi   = $_POST["gi"."".$i];
        $nomortrafo  = $_POST["nomortrafo"."".$i];
        $pic = $_POST["pic"."".$i];
        $pemilikaset = $_POST["pemilikaset"."".$i];
        $picpemeliharaan = $_POST["picpemeliharaan"."".$i];
        $mulai = $_POST["mulai"."".$i];
        $normal = $_POST["normal"."".$i];
        $keterangan = $_POST["keterangan"."".$i];
        mysql_query("INSERT INTO gangguan(kodegangguan, kodeapp, kodegi, nomortrafo, pic, pemilikaset, picpemeliharaan, mulai, normal, keterangan) VALUES('', '$_SESSION[kodeapp]', '$gi', '$nomortrafo', '$pic', '$pemilikaset', '$picpemeliharaan', '$mulai', '$normal', '$keterangan')");

        header("location:?gangguan&suksestambah");
    }
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
                    <h2>Data Daftar Gangguan </h2>
                </div>
            </div>
             <!-- /. ROW  -->
             <hr />
   			<div class="row">
				<div class="col-lg-12">
    				<div class="panel panel-default">
			            <div class="panel-heading">
			                Form Gangguan
			            </div>
        				<div class="panel-body">
            				<div class="row">
                				<div class="col-lg-12">
									<form id="validate-me-plz" name="formgangguan" role="form" action="" method="post"  onSubmit="return validasi('submit')">
                                        <table  class="table" id="tblSample">
	                        				<tr >
					                        	<td colspan="7">
													<a href="#" onClick="validasi('tambah');" class="btn btn-sm btn-success">
														<i class="fa fa-plus-square"></i> Tambah
													</a>
					                 				<a href="#" onClick="removeRowFromTable();" class="btn btn-sm btn-info">
														<i class="fa fa-minus-square"></i> Kurang
													</a>
												</td>
	                        				</tr>
					                        <tr class="TableHeader1">
												<th style="text-align:center; vertical-align: middle;">No</th>
											    <th style="text-align:center; vertical-align: middle;">Gardu Induk</th>
											    <th style="text-align:center; vertical-align: middle;">No. Trafo</th>
											    <th style="text-align:center; vertical-align: middle;">PIC<br>TL/INC/TRF</th>
											    <th style="text-align:center; vertical-align: middle;">Pemilik Aset<br>TL/INC/TRF</th>
											    <th style="text-align:center; vertical-align: middle;">PIC Pemeliharaan<br>Internal/Eksternal</th>
											    <th style="text-align:center; vertical-align: middle;">Mulai<br>Tanggal / Jam</th>
											    <th style="text-align:center; vertical-align: middle;">Normal<br>Tanggal / Jam</th>
											    <!-- <th style="text-align:center;">Durasi Padam</th> -->
											    <th style="text-align:center; vertical-align: middle;">Keterangan</th>
					                        </tr>
					                        <tr>
												<td style="text-align:center; vertical-align: middle;" class="Tablefield">1
			                                        <input type="hidden" name="number" id="number" value="1" />
                                                </td>
											    <td>
                                                    <div id="suggest">
                                                       <input type="text" name="gi1" style="width: 90%;" id="gi1" class="form-control pull-left" readonly=""/>&nbsp;<a HREF='#'  onClick="findsubject=dhtmlwindow.open('fdsubject', 'iframe', 'page/gangguan/cari.php?flag=1', 'Daftar Gardu Induk', 'width=700px,height=350px,top=130px,left=250px,resize=1,scrolling=1'); return false"><i class="fa fa-search-plus fa-2x"></i></a>
                                                       <div class="suggestionsBox" id="suggestions" style="display: none;">
                                                       <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
                                                       </div>
                                                    </div>
												</td>
											    <td>
													<select class="form-control" name="nomortrafo1" id="nomortrafo1" data-rule-required="true">
														<option value=""></option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</td>
											    <td>
													<select class="form-control" name="pic1" id="pic1" data-rule-required="true">
														<option value=""></option>
														<option value="TRF">TRF</option>
														<option value="TL/IBT">TL/IBT</option>
														<option value="INC">INC</option>
														<option value="DIS">DIS</option>
														<option value="P2B">P2B</option>
													</select>
												</td>
											    <td>
													<select class="form-control" name="pemilikaset1" id="pemilikaset1" data-rule-required="true">
														<option value=""></option>
														<option value="TRF">TRF</option>
														<option value="TL/IBT">TL/IBT</option>
														<option value="INC">INC</option>
														<option value="DIS">DIS</option>
														<option value="P2B">P2B</option>
													</select>
												</td>
											    <td>
													<select class="form-control" name="picpemeliharaan1" id="picpemeliharaan1" data-rule-required="true">
														<option value=""></option>
														<option value="internal">Internal</option>
														<option value="external">External</option>
													</select>
												</td>
											    <td><input type="text" name="mulai1" id="mulai1"/></td>
											    <td><input type="text" name="normal1" id="normal1"/></td>
											    <td><textarea name="keterangan1"></textarea></td>
					                        </tr>
					                	</table>
                                        <!-- <div class="row">
						                    <div class="col-md-7">
						                        <div class="col-md-6"></div>
						                        <div class="col-md-3"><span id="jqueryblink" class="text-danger">Belum Balance</span></div>
						                        <div class="col-md-3"><b>Total</b></div>
						                    </div> -->
						                    <!-- <div class="col-md-5">
						                        <div class="col-md-4">
						                            Rp <input style="border:none; font-size:14px; color:#990000; width: 80%; " type="text" name="totalD"  id="totalD"  onKeyup="totaldebet()" />
						                        </div>
						                        <div class="col-md-4">
						                            Rp <input style="border:none; font-size:14px; color:#990000; width: 80%;" type="text" name="totalK"  id="totalK"  onKeyup="totalkredit()" />
						                        </div>
						                    </div> -->
						                </div>
								        <button class="btn btn-large btn-default" name="simpan" id="simpan">Simpan</button>
								        <a href="?gangguan" class="btn btn-large btn-warning">Kembali</a>
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
<script src="assets/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script>
    $('#mulai1').datetimepicker({
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
