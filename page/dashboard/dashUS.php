<?php
$sessAnggota = $_SESSION["no_anggota"];
$sqlSimSetor      = mysql_query("SELECT SUM(jumlah) as jumlah FROM tabel_simpanan Where jenis = 'setor' AND no_anggota = '$sessAnggota' ORDER BY kode_simpanan ASC") or die (mysql_error());
$rowsimSetor      = mysql_fetch_array($sqlSimSetor);
$sqlSimTarik      = mysql_query("SELECT SUM(jumlah) as jumlah FROM tabel_simpanan Where jenis = 'tarik' AND no_anggota = '$sessAnggota' ORDER BY kode_simpanan ASC") or die (mysql_error());
$rowsimTarik      = mysql_fetch_array($sqlSimTarik);

$Simpanan = $rowsimSetor['jumlah'] - $rowsimTarik['jumlah'];


$sqlPin      = mysql_query("SELECT SUM(jumlah_pinjaman) as jumlah,(jangka_waktu*jumlah_angsuran) jmlpinj FROM tabel_pinjaman WHERE no_anggota = '$sessAnggota' ORDER BY kode_pinjaman ASC") or die (mysql_error());
$rowPin      = mysql_fetch_array($sqlPin);

$sqlAngs      = mysql_query("SELECT sum(angsuran_bayar) as jumlah, (angsuran_ke*angsuran_bayar) jmlangs FROM tabel_angsuran where status_angsuran = 'Lunas' AND no_anggota = '$sessAnggota' ORDER BY kode_angsuran DESC") or die (mysql_error());
$hitungAngs   = mysql_fetch_array($sqlAngs);
// echo "SELECT sum(angsuran_bayar) as jumlah, angsuran_ke, angsuran_bayar FROM tabel_angsuran where status_angsuran = 'Lunas' AND no_anggota = '$sessAnggota' ORDER BY kode_angsuran DESC";
$sqlAngsbunga      = mysql_query("SELECT sum(bunga_angs) as bunga FROM tabel_angsuran where status_angsuran = 'Lunas' AND no_anggota = '$sessAnggota' ORDER BY kode_angsuran ASC") or die (mysql_error());
$hitungAngsbunga   = mysql_fetch_array($sqlAngsbunga);

$sqlSwsetor   = mysql_query("SELECT sum(jumlah) as jmlsimpan FROM tabel_simpanan where jenis_simpanan = 'Simpanan Wajib' and jenis='setor' AND no_anggota = '$sessAnggota' ORDER BY kode_simpanan ASC") or die (mysql_error());
$rowSwsetor   = mysql_fetch_array($sqlSwsetor);

$sqlSpsetor      = mysql_query("SELECT sum(jumlah) as jmlsimpan FROM tabel_simpanan where jenis_simpanan = 'Simpanan Pokok' and jenis='setor' AND no_anggota = '$sessAnggota' ORDER BY kode_simpanan ASC") or die (mysql_error());
$rowSpsetor   = mysql_fetch_array($sqlSpsetor);

$sqlSsetor      = mysql_query("SELECT sum(jumlah) as jmlsimpan FROM tabel_simpanan where jenis_simpanan = 'Simpanan Sukarela' and jenis='setor' AND no_anggota = '$sessAnggota' ORDER BY kode_simpanan ASC") or die (mysql_error());
$rowSsetor   = mysql_fetch_array($sqlSsetor);

$sqlSwtarik   = mysql_query("SELECT sum(jumlah) as jmlsimpan FROM tabel_simpanan where jenis_simpanan = 'Simpanan Wajib' and jenis='tarik' AND no_anggota = '$sessAnggota' ORDER BY kode_simpanan ASC") or die (mysql_error());
$rowSwtarik   = mysql_fetch_array($sqlSwtarik);

$sqlSptarik      = mysql_query("SELECT sum(jumlah) as jmlsimpan FROM tabel_simpanan where jenis_simpanan = 'Simpanan Pokok' and jenis='tarik' AND no_anggota = '$sessAnggota' ORDER BY kode_simpanan ASC") or die (mysql_error());
$rowSptarik   = mysql_fetch_array($sqlSptarik);

$sqlSstarik      = mysql_query("SELECT sum(jumlah) as jmlsimpan FROM tabel_simpanan where jenis_simpanan = 'Simpanan Sukarela' and jenis='tarik' AND no_anggota = '$sessAnggota' ORDER BY kode_simpanan ASC") or die (mysql_error());
$rowSstarik   = mysql_fetch_array($sqlSstarik);

$sisaSw = $rowSpsetor['jmlsimpan'] - $rowSptarik['jmlsimpan'];

$sisaSp = $rowSwsetor['jmlsimpan'] - $rowSwstarik['jmlsimpan'];

$sisaSs = $rowSsetor['jmlsimpan'] - $rowSstarik['jmlsimpan'];

$pinj = mysql_query("select * from tabel_pinjaman where kode_pinjaman='".$angsuran['no_pinjaman']."'");
$hpinj = mysql_fetch_array($pinj);

$sisapinjaman = $rowPin['jmlpinj'] - $hitungAngs['jmlangs'];

$sqlnews      = mysql_query("SELECT * FROM tabel_berita ORDER BY id_berita DESC") or die (mysql_error());

?>
<script type="text/javascript" src="assets/jqueryeasyticker/jquery.easing.min.js"></script>
<script type="text/javascript" src="assets/jqueryeasyticker/jquery.easy-ticker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var dd = $('.newsheadline').easyTicker({
		direction: 'up',
		easing: 'easeInOutBack',
		speed: 'slow',
		interval: 3000,
		height: 'auto',
		visible: 4,
		mousePause: 0,
	}).data('easyTicker');	
	
});
</script>

<style>

.newsheadline ul{
	padding: 0;
    width: 80%;
}
.newsheadline li{
	list-style: none;
	border-bottom: 1px solid green;
	
}
hr , h2{margin: 5px 0;}
.et-run{
	background: red;
}
</style>
<div id="page-wrapper" >
<div id="page-inner">
                             
                 <!-- /. ROW  -->
                 <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <h2>Beranda Aplikasi Simpan Pinjam </h2>
                        <hr />
                        <div class="row">
                           <div class="col-md-4 col-sm-6 col-xs-6">           
                			<div class="panel panel-back noti-box">
                                <center>
                                <a href="?detail-simpanan">
                                    <span class="icon-box hov bg-color-green set-icon"><i class="fa fa-inbox"></i></span>
                                </a>
                                <div class="text-box" >
                                    <a href="?detail-simpanan&simpanan-all">
                                    <p class="main-text">Nominal simpanan </br><?php echo 'Rp. ' . number_format( $Simpanan, 0 , '' , '.' ); ?>  </p>
                                    </a>
                                <!--    <a href="?simpanan" class="btn btn-info btn-block ">Selengkapnya</a> -->
                                </div>
                                </center>
                             </div>
            		     </div>
                         <div class="col-md-4 col-sm-6 col-xs-6"> 
                                    <center>          
                        			<div class="panel panel-back noti-box">
                                        <a href="?detail-pinjaman">
                                        <span class="icon-box hov bg-color-brown set-icon">
                                            <i class="fa fa-external-link-square "></i>
                                        </span>
                                        </a>
                                        <div class="text-box" >
                                            <a href="?detail-pinjaman">
                                                <p class="main-text">Nominal  pinjaman Pokok <br /><?php echo 'Rp. ' . number_format( $rowPin["jumlah"], 0 , '' , '.' ); ?>  </p>
                                            </a>
                                        </div>
                                     </div>
                                     </center>
                    		     </div>
                         <div class="col-md-4 col-sm-6 col-xs-6"> 
                                        <center>          
                            			<div class="panel panel-back noti-box">
                                            <a href="?TSimWjb">
                                                <span class="icon-box hov bg-color-green set-icon">
                                                <i class="glyphicon glyphicon-list-alt"></i>
                                                </span>
                                            </a>
                                            <div class="text-box" >
                                                <a href="?TSimWjb">
                                                <p class="main-text">Nominal Sisa Tunggakan <br /><?php echo 'Rp. '.number_format($sisapinjaman,0,'','.'); ?></p>
                                                </a>
                                            </div>
                                         </div>
                                         </center>
                  		     </div> 
                            
        			</div> 
                           <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-6"> 
                                    <center>          
                        			<div class="panel panel-back noti-box">
                                        <a href="?detail-simpanan&simpanan-wajib">
                                            <span class="icon-box hov bg-color-brown set-icon">
                                                <i class="fa fa-align-justify"></i>
                                            </span>
                                        </a>
                                        <div class="text-box" >
                                        <a href="?detail-simpanan&simpanan-wajib">
                                            <p class="main-text">Nominal </br> Simpanan Pokok<br /><?php echo 'Rp. ' . number_format( $sisaSp, 0 , '' , '.' ); ?>  </p>
                                        </a>
                                        </div>
                                     </div>
                                     </center>
                    		     </div>
                                  <div class="col-md-4 col-sm-6 col-xs-6"> 
                                        <center>          
                            			<div class="panel panel-back noti-box">
                                            <a href="?detail-simpanan&simpanan-pokok">
                                                <span class="icon-box hov bg-color-green set-icon">
                                                    <i class="fa fa-outdent"></i>
                                                </span>
                                            </a>
                                            <div class="text-box" >
                                            <a href="?detail-simpanan&simpanan-pokok">
                                                <p class="main-text">Nominal <br />Simpanan Wajib<br /><?php echo 'Rp. '.number_format($sisaSw,0,'','.'); ?></p>
                                            </a>
                                            </div>
                                         </div>
                                         </center>
                        		     </div> 
                                      <div class="col-md-4 col-sm-6 col-xs-6"> 
                                        <center>          
                            			<div class="panel panel-back noti-box">
                                            <a href="?detail-simpanan&simpanan-sukarela">
                                                <span class="icon-box hov bg-color-blue set-icon">
                                                    <i class="fa fa-align-right"></i>
                                                </span>
                                            </a>
                                            <div class="text-box" >
                                                <a href="?detail-simpanan&simpanan-sukarela">
                                                    <p class="main-text">Nominal <br />Simpanan Sukarela <br /><?php echo 'Rp. '.number_format($sisaSs,0,'','.'); ?></p>
                                                </a>
                                            </div>
                                         </div>
                                         </center>
                        		     </div> 
                           </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 " style="height: 50%;">
                    <h3 style="margin: 9px 0;">Berita KP3</h3>
                    <hr style="width: 80%;" />
                    <div class="newsheadline">
                        	<ul>
                            <?php
                            if(mysql_num_rows($sqlnews) > 0){
       				         
                            while($rownews=mysql_fetch_array($sqlnews))
       				         {
       				             ?>
                            
                        		<li>
                                <br />
                                    <div class="row" >
                                        <div class="col-md-4">
                                            <a href="?detail-berita=<?php echo $rownews['id_berita']; ?>">
                                                <img src="<?php echo $rownews["gambar"] == "" ? "images/berita/no-images.png" : "images/berita/".$rownews["gambar"] ?>" style="width: 100%;" />
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <h3><a href="?detail-berita=<?php echo $rownews['id_berita']; ?>"><?php echo $rownews['judul'];?></a></h3>
                                            <span><?php echo tglindonesia($rownews['datetime']);?></span>
                                            <p class="text-isi"><?php echo $rownews['sinopsis'];?></p>
                                        </div>
                                    </div>
                                    <br />
                                </li>
                        	
                            <?php  } } else { ?>
                            <li> data berita kosong </li>
                            <?php } ?>
                            </ul>
                         
                        </div>
                    </div>
                    
                 </div>
                 
   </div>
<!-- /. PAGE INNER  -->
</div>