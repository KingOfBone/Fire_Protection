<?php
if(isset($_POST["cari"])){
    $key     = (tglwaktuformataction($_POST['tglawal'])) ? tglwaktuformataction($_POST['tglawal']) : tglwaktuformataction($_GET['tglawal']);
    $key2     = (tglwaktuformataction($_POST['tglakhir'])) ? tglwaktuformataction($_POST['tglakhir']) : tglwaktuformataction($_GET['tglakhir']);

    if (! $key=="" && !$key2==""){ $q = " tsa.eo.mulai >= '$key' and date_sub(tsa.eo.mulai, INTERVAL 1 day) <= '$key2'";  }

    if($_SESSION["jenisuser"]=="gi"){
        $sql=mysql_query("SELECT tsa.eo.*, master.gi.*, master.trafo.*, (TIMEDIFF(tsa.eo.normal,tsa.eo.mulai)) as jumlahjam FROM tsa.eo INNER JOIN master.gi ON tsa.eo.kodegi = master.gi.kodegi INNER JOIN master.trafo ON tsa.eo.kodetrafo = master.trafo.kodetrafo WHERE $q AND tsa.eo.kodegi = $_SESSION[kodegi] ORDER BY tsa.eo.mulai DESC") or die (mysql_error());
    }
    else if($_SESSION["jenisuser"]=="app"){
        $sql=mysql_query("SELECT tsa.eo.*, master.gi.*, master.trafo.*, (TIMEDIFF(tsa.eo.normal,tsa.eo.mulai)) as jumlahjam FROM tsa.eo INNER JOIN master.gi ON tsa.eo.kodegi = master.gi.kodegi INNER JOIN master.trafo ON tsa.eo.kodetrafo = master.trafo.kodetrafo WHERE $q AND tsa.eo.kodeapp = $_SESSION[kodeapp] ORDER BY tsa.eo.mulai DESC") or die (mysql_error());
    }
}?>

<div id="wrapper">
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Laporan Emergency Outage</h2>
                    <hr />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Table laporan emergency outage</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="validate-me-plz" name="form_akun" role="form" action="" method="post" >
                                     <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2"><label>Pilih Periode :</label></div>
                                                <div class="col-md-3">
                                                    <input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datetimepicker1" name="tglawal" data-rule-required="true" data-msg-required="Mohon masukkan data tanggal daftar." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" placeholder="isikan kolom tanggal" value="<?php if(isset($_POST["cari"])){ echo $_POST["tglawal"]; } ?>" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" onKeyPress="return isNumberKeyTgl(event)" class="form-control" id="datetimepicker2" name="tglakhir" data-rule-required="true" data-msg-required="Mohon masukkan data tanggal daftar." data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" placeholder="isikan kolom tanggal" value="<?php if(isset($_POST["cari"])){ echo $_POST["tglakhir"]; } ?>" />
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-sm btn-success" name="cari" type="submit"> Cari</button>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="page/eo/cetak.php?act=print&tglawal=<?php echo $_POST["tglawal"]; ?>&tglakhir=<?php echo $_POST["tglakhir"]; ?>" target="_blank"><img src="images/print.png" title="cetak dokumen" /></a>
                                                    <a href="page/eo/cetak.php?act=excel&tglawal=<?php echo $_POST["tglawal"]; ?>&tglakhir=<?php echo $_POST["tglakhir"]; ?>"><img src="images/excel.png" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php if(isset($_POST["cari"])) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="datatabel">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">No</th>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">Gardu Induk</th>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">No. Trafo</th>
                                            <th style="text-align:center; vertical-align: middle;">PIC</th>
                                            <th style="text-align:center; vertical-align: middle;">Mulai</th>
                                            <th style="text-align:center; vertical-align: middle;">Normal</th>
                                            <th style="text-align:center; vertical-align: middle;" colspan="2">Durasi Padam</th>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">Keterangan</th>
                                            <th style="text-align:center; vertical-align: middle;" rowspan="2">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align:center; vertical-align: middle;">TJBT / NON TJBT</th>
                                            <th style="text-align:center; vertical-align: middle;">Tanggal / Jam</th>
                                            <th style="text-align:center; vertical-align: middle;">Tanggal / Jam</th>
                                            <th style="text-align:center; vertical-align: middle;">Jam:Menit</th>
                                            <th style="text-align:center; vertical-align: middle;">Jam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(mysql_num_rows($sql) > 0){
                                            $no=1;
                                            while($row=mysql_fetch_array($sql))
                                            { ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['namagi'];?></td>
                                                    <td><?php echo $row['nomortrafo'];?></td>
                                                    <td><?php echo $row['pic'];?></td>
                                                    <td><?php echo $row['mulai'];?></td>
                                                    <td><?php echo $row['normal'];?></td>
                                                    <td><?php echo $row['jumlahjam'];?></td>
                                                    <td>
                                                        <?php
                                                            $sql1 = mysql_query("SELECT HOUR('$row[jumlahjam]') as jam, MINUTE('$row[jumlahjam]') as menit") or die(mysql_error());
                                                            $row1 = mysql_fetch_array($sql1);
                                                            $a = $row1['jam'];
                                                            $b = $row1['menit'];
                                                            echo $c = number_format((($a*60) + $b)/60,2);
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['keterangan'];?></td>
                                                    <td class="text-center">
                                                        <a href="index.php?update-eo=<?php echo $row["kodeeo"]?>" type="button"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="#" id="delete-eo=<?php echo $row["kodeeo"]?>" class="delete">
                                                            <i class="fa fa-trash-o fa-2x"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $no++;
                                            }
                                        } else { ?>
                                            <tr><td colspan="8" class="text-center"><i>Tabel data kosong</i></td></tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script>
    $.datetimepicker.setLocale('id');
    $('#datetimepicker1').datetimepicker({
        dayOfWeekStart : 1,
        lang:'en',
        timepicker:false,
        disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
        startDate:	new Date(),
        defaultDate: new Date(),
        format:'d-m-Y'
	});

	$('#datetimepicker2').datetimepicker({
        dayOfWeekStart : 1,
        lang:'en',
        timepicker:false,
        disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
        startDate:	new Date(),
        defaultDate: new Date(),
        format:'d-m-Y'
	});
</script>

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
