<style>
:required:focus {
  box-shadow: 0  0 3px rgba(255,0,0,0.5);
  outline: none;
}

</style>
<link rel="stylesheet" href="lib/pickday/css/pikaday.css" />
<div class="row">
    <div class="col-md-12">
        <h4 align="center">LAPORAN TRAFO</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
    <strong style="margin: 0 13px;">Periode :</strong>
    <form name="" id="form-laporan" method="post" action="">
        <div class="form-group">
            <div class="col-md-2">
                <input type="text" autocomplete="off" placeholder="tanggal awal"  name='tglawal' value="<?php echo  $_POST["tglawal"]?>" class="form-control"  id="tglawal" onKeyPress="return isNumberKeyTgl(event)"   />

            </div>
            <p class="pull-left">S / D</p>
            <div class="col-md-2">
                <input type="text" autocomplete="off" placeholder="tanggal awal"  name='tglakhir' value="<?php echo $_POST["tglakhir"]?>" class="form-control"  id="tglakhir" onKeyPress="return isNumberKeyTgl(event)"   />
            </div>
            <div class="col-md-2" style="padding: 0;">
                <button name="submit" style="padding: 9px 13px;" name="submit" id="submit" class="btn btn-primary btn-large"><i class="fa fa-search-plus" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    </div>
</div>
<br />
<div class="row">
    <div class="col-md-12">
        <div class="panel-container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Laporan Rincian Trafo</b>
                </div>
                <div class="panel-body">
                    <div id="table-container">
                        <table class="table table-bordered table-hover " id="datatabel1">
                        <thead>
                           <tr >
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
                            $no = 1;
                            if(isset($_POST["submit"])){
                                //$pekerjaan  = $_POST["pekerjaan"];
                                $tglawal    = tglformataction($_POST["tglawal"]);
                                $tglakhir   = tglformataction($_POST["tglakhir"]);

                            $sqlp = mysql_query("SELECT * FROM trafo WHERE tgloprs >='$tglawal' AND tgloprs <='$tglakhir'");
                            $num = mysql_num_rows($sqlp);
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row['namagi'];?></td>
                                <td><?php echo $row['namabay'];?></td>
                                <td><?php echo $row['tgloprs'];?></td>
                                <td><?php echo $row['merk'];?></td>
                                <td><?php echo $row['thnbuat'];?></td>
                                ?></a></td>

                            </tr>
                        <?php $no++; } } }  else {?>
                            <tr class="text-center">
                                <td colspan="9">Data Pengadaan Kosong</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        </table>
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
 field: document.getElementById("tglawal"),
 firstDay: 1,
 minDate: new Date(1960, 0, 1),
 maxDate: new Date(2020, 12, 31),
 yearRange: [1960, 2020],
 format: 'DD/MM/YYYY'
});
var picker = new Pikaday({
 field: document.getElementById("tglakhir"),
 firstDay: 1,
 minDate: new Date(1960, 0, 1),
 maxDate: new Date(2020, 12, 31),
 yearRange: [1960, 2020],
 format: 'DD/MM/YYYY'
});
function isNumberKeyTgl(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
     //    if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
</script>
