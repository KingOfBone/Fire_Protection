<?php
    if(isset($_POST["cari"])){
        $key     = (tglformataction($_POST['tglAwal'])) ? tglformataction($_POST['tglAwal']) : tglformataction($_GET['tglAwal']);
        $key2     = (tglformataction($_POST['tglAkhir'])) ? tglformataction($_POST['tglAkhir']) : tglformataction($_GET['tglAkhir']);

        if (! $key=="" && !$key2==""){ $q = " trafo.tgloprs >= '$key' and date_sub(trafo.tgloprs, INTERVAL 1 day) <= '$key2'";  }

        $sql=mysql_query("SELECT
        trafo.kodetrafo,
        trafo.kodegi,
        trafo.namabay,
        trafo.serialid,
        trafo.typeid,
        trafo.idbay,
        trafo.kodepst,
        trafo.kodestatus,
        trafo.tegoprs,
        trafo.tgloprs,
        trafo.impdns,
        trafo.kodemerk,
        trafo.thnbuat,
        trafo.jenis,
        trafo.penempatan,
        trafo.keterangan,
        trafo.flag,
        trafo.jeniskonsv,
        trafo.tglhistory,
        trafo.tmsaktif,
        trafo.tegoperasi,
        trafo.idfireprotection,
        trafo.idproteksimekanik,
        trafo.idonlinemonitoring,
        trafo.constype,
        trafo.description,
        trafo.asset,
        trafo.techidentno,
        trafo.eqnumber,
        trafo.daya,
        trafo.vectorx,
        trafo.equipmentnumber,
        trafo.idfunctloc,
        trafo.tipe,
        trafo.tegprimrated,
        trafo.tegsecrated,
        trafo.tegprimmax,
        trafo.tegsecmax,
        trafo.tegtermax,
        trafo.arusprim,
        trafo.arussec,
        trafo.aruster,
        trafo.vector,
        trafo.bil,
        trafo.sil,
        trafo.pfwv,
        trafo.suhu,
        trafo.suhunaikw,
        trafo.suhunaiko,
        trafo.cooling,
        trafo.jmlkips,
        trafo.jnsisokertas,
        trafo.klsiso,
        trafo.panjang,
        trafo.lebar,
        trafo.tinggi,
        trafo.brtminyak,
        trafo.brtintibltn,
        trafo.brttot,
        trafo.jnsminyak,
        trafo.jrkroda,
        trafo.jrkas,
        trafo.standard,
        trafo.pasangan,
        trafo.bilsec,
        trafo.bilter,
        trafo.pfwsec,
        trafo.pfwter,
        trafo.brtmainfitting,
        trafo.dayater,
        trafo.deltategtap,
        trafo.jmlcoolingpump,
        trafo.jmlgroupkipas,
        trafo.jmltap,
        trafo.tegtapbawah,
        trafo.tegtapatas,
        trafo.tegtapnormal,
        trafo.tipeminyak,
        trafo.waktusc,
        trafo.image,
        gi.namagi,
        app.namaapp,
        merk.merk,
        buatan.buatan
        FROM
        trafo
        INNER JOIN gi ON gi.kodegi = trafo.kodegi
        INNER JOIN app ON app.kodeapp = gi.kodeapp
        INNER JOIN merk ON merk.kodemerk = trafo.kodemerk
        INNER JOIN buatan ON buatan.kodebuatan = merk.kodebuatan
        WHERE $q ORDER BY trafo.kodetrafo
        ") or die (mysql_error());
    }
?>

<!-- autocomplete-->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<link rel="stylesheet" href="assets/Actextbox/jquery-ui.css">
<script src="assets/Actextbox/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#skills" ).autocomplete({
            source: 'assets/Actextbox/search.php'
        });
    });
</script>

<div id="wrapper">
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Laporan Trafo</h2>
                    <hr />
                </div>
            </div>
            <form method="POST" action="" id="validate-cari">
                <div class="row">
                    <div class="col-md-2"><p style="padding: 0;" class="">Periode </p></div>
                    <div class="col-md-3">
                        <input  type="text" onKeyPress="return isNumberKeyTgl(event)" value="<?php  echo $_POST["tglAwal"];?>" class="form-control" id="datepicker" name="tglAwal" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl Oprs." placeholder="masukkan Tgl Oprs" />
                    </div>
                    <div class="col-md-1">S / D</div>
                    <div class="col-md-3">
                        <input  type="text" onKeyPress="return isNumberKeyTgl(event)" value="<?php  echo $_POST["tglAkhir"];?>" class="form-control" id="datepicker2" name="tglAkhir" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data Tgl Oprs." placeholder="masukkan Tgl Oprs" />
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" type="submit" name="cari">Cari</button>
                    </div>
                    <div class="col-md-1">
                        <?php if(isset($_POST["cari"])){ ?>
                            <a target="_blank" href="page/laporan/cetak/cetak-lap-trafo.php?keycetak1=<?php echo $key; ?>&keycetak2=<?php echo $key2; ?>"><img class="img-responsive" src="images/excel.png" /></a>
                        <?php } ?>
                    </div>
                </div>
            </form>
            <br /><br />

            <?php if(isset($_POST["cari"])) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Tabel data Trafo</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="datatabel">
                                        <thead>
                                            <tr>
                                                <th width="2%">No</th>
                                                <th width="10%">Nama Gardu Induk</th>
                                                <th width="17%">Nama Bay</th>
                                                <th width="13%">Tanggal Operasi</th>
                                                <th width="14%">Merk</th>
                                                <th width="10%">Tahun Buat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(mysql_num_rows($sql)>0){
                                                    $no=1;
                                                    while($row=mysql_fetch_array($sql)){
                                            ?>
                                                        <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $row['namagi'];?></td>
                                                            <td><?php echo $row['namabay'];?></td>
                                                            <td><?php echo $row['tgloprs'];?></td>
                                                            <td><?php echo $row['merk'];?></td>
                                                            <td><?php echo $row['thnbuat'];?></td>
                                                        </tr>
                                                    <?php $no++; } } else { ?>
                                                    <tr><td colspan="9" class="text-center"><i>Tabel data trafo kosong</i></td></tr>
                                                    <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1960, 2020],
        format: 'DD/MM/YYYY'
    });
</script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker2'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1960, 2020],
        format: 'DD/MM/YYYY'
    });
</script>

<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">
    $('#validate-cari').validate({
        rules: {
            field: {
                required: true,
            date: true
            }
        }
    });
    jQuery.validator.methods["date"] = function (value, element) { return true; }
</script>

<script src="assets/confirmdell/js/script.js"></script>
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
