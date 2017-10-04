<?php
if(isset($_POST["cari"])){
    
    $key     = (tglformataction($_POST['tglAwal'])) ? tglformataction($_POST['tglAwal']) : tglformataction($_GET['tglAwal']);
    $key2     = (tglformataction($_POST['tglAkhir'])) ? tglformataction($_POST['tglAkhir']) : tglformataction($_GET['tglAkhir']);
    
    if (! $key=="" && !$key2==""){ $q = " and tabel_angsuran.tgl_angsuran >= '$key' and date_sub(tabel_angsuran.tgl_angsuran, INTERVAL 1 day) <= '$key2'"; }
    
    $tunggak = mysql_query("SELECT
tabel_anggota.no_anggota,
tabel_anggota.nama_anggota,
tabel_angsuran.angsuran_bayar,
tabel_angsuran.status_angsuran,
tabel_angsuran.tgl_angsuran
FROM
tabel_anggota ,
tabel_angsuran
WHERE tabel_angsuran.status_angsuran='Belum Lunas' $q ") or die (mysql_error());

$jmltunggak = mysql_query("SELECT SUM(tabel_angsuran.angsuran_bayar) as jumlah
FROM
tabel_anggota ,
tabel_angsuran
WHERE tabel_angsuran.status_angsuran='Belum Lunas'
 $q ") or die (mysql_error());
    
    $jml2 = mysql_fetch_array($jmltunggak);
    
    
    
}
?>
<script type="text/javascript">
    
      function isNumberKeyTgl(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
     //    if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
</script>
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
                        <h2>Laporan Tunggakan</h2>
                        <hr />
                    </div>
                    
                    
                </div>
              
           
           <form method="POST" action="" id="validate-cari">
                <div class="row">
                    <div class="col-md-1"><p style="padding: 0;" class="">Periode </p></div>
                    <div class="col-md-3">
                        <input type="text" class='form-control' onKeyPress="return isNumberKeyTgl(event)" value="<?php  echo $_POST["tglAwal"];?>" id="datepicker" name="tglAwal" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data tanggal." placeholder="klik kolom tanggal">
                    </div>
                    <div class="col-md-1">S / D</div>    
                    <div class="col-md-3">
                        <input type="text" class='form-control' onKeyPress="return isNumberKeyTgl(event)" value="<?php  echo $_POST["tglAkhir"];?>" id="datepicker2" name="tglAkhir" data-rule-required="true" data-rule-date="true" data-msg-date="format yang benar dd/mm/yyyy" data-msg-required="mohon masukkan data tanggal." placeholder="klik kolom tanggal">
                    </div>
                    <div class="col-md-2"><button class="btn btn-primary" type="submit" name="cari">Cari</button></div>
                    <div class="col-md-2 ">
                        <?php if(isset($_POST["cari"])){ ?>
                            <a target="_blank" href="page/laporan/cetak/lapCetakTunggakan.php?keycetak1=<?php echo $key; ?>&keycetak2=<?php echo $key2; ?>"><img class="img-responsive pull-right" src="images/excel.png" /></a>
                        <?php } ?>
                    </div>
                </div>
                    
                <br />
           </form>
           
           <br /><br />
           <?php if(isset($_POST["cari"])) { ?>
          
            <?php /* Tarik simpanan */ ?>
           <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel laporan tunggakan
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                  						    <th width="17%">No Anggota</th>
                                            <th width="17%">Nama</th>
                      						<th width="15%">Tanggal Angsuran</th>
                                            <th width="15%">Angsuran Bayar</th>
                      						<th width="20%">Status Angsuran</th>
                                           
                       					</tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(mysql_num_rows($tunggak) > 0){
                                    $no=1;
                                    while($rowtarik=mysql_fetch_array($tunggak))
                    				{
                    				    ?>
                            					<tr>
                                                    <td><?php echo $no; ?></td>
                            						<td><?php echo $rowtarik['no_anggota'];?></td>
                            						<td><?php echo $rowtarik['nama_anggota'];?></td>
                            						<td><?php echo tglindonesia($rowtarik['tgl_angsuran']);?></td>
                                                    <td><?php echo 'Rp. ' . number_format( $rowtarik['angsuran_bayar'], 0 , '' , '.' );?></td>
                                                   <td><?php echo $rowtarik['status_angsuran'];?></td>
                            					</tr>
                         			<?php $no++; } } else { ?>
                                                <tr><td colspan="9" class="text-center"><i>Tabel data tarik simpanan anggota kosong</i></td></tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                                <p class="text-right">Total <?php echo 'Rp. ' . number_format( $jml2["jumlah"], 0 , '' , '.' ); ?></p>
                            </div>
                            
                        </div>
                    </div>
              <?php } ?> 
               
    </div>
</div>
</div></div></div>
<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>

  <script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date(2000, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1990, 2020],
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
<!-- validate -->
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





