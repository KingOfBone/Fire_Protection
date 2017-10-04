<?php
$sqlAng      = mysql_query("SELECT * FROM tabel_anggota ORDER BY kode_anggota ASC") or die (mysql_error());
$hitungAng   = mysql_num_rows($sqlAng);

$sqlSimSetor      = mysql_query("SELECT SUM(a.jumlah) as jumlah FROM tabel_simpanan a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.jenis = 'setor' ORDER BY a.kode_simpanan ASC") or die (mysql_error());
$rowsimSetor      = mysql_fetch_array($sqlSimSetor);
$sqlSimTarik      = mysql_query("SELECT SUM(a.jumlah) as jumlah FROM tabel_simpanan a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.jenis = 'tarik' ORDER BY a.kode_simpanan ASC") or die (mysql_error());
$rowsimTarik      = mysql_fetch_array($sqlSimTarik);

$Simpanan = $rowsimSetor['jumlah'] - $rowsimTarik['jumlah'];

$sqlPer      = mysql_query("SELECT distinct(no_anggota) FROM tabel_pinjaman") or die (mysql_error());
$hitungPer   = mysql_num_rows($sqlPer);

/* $sqlPin      = mysql_query("SELECT SUM(a.jumlah_pinjaman) as jumlah FROM tabel_pinjaman a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' ORDER BY a.kode_pinjaman ASC") or die (mysql_error());
*/
$sqlPin = mysql_query("select sum(a.jangka_waktu*a.jumlah_angsuran) as jmlpinj ,sum(a.jumlah_pinjaman) as jumlah, (select sum(angsuran_bayar * angsuran_ke) as angs from tabel_angsuran) as jmlangs from tabel_pinjaman a");
$rowPin      = mysql_fetch_array($sqlPin); 


$sqlAngs      = mysql_query("SELECT sum(a.angsuran_bayar) as jumlah FROM tabel_angsuran a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.status_angsuran = 'Lunas' ORDER BY a.kode_angsuran ASC") or die (mysql_error());
$hitungAngs   = mysql_fetch_array($sqlAngs);


$sqlAngsbunga      = mysql_query("SELECT sum(a.bunga_angs) as bunga FROM tabel_angsuran a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.status_angsuran = 'Lunas' ORDER BY a.kode_angsuran ASC") or die (mysql_error());
$hitungAngsbunga   = mysql_fetch_array($sqlAngsbunga);

$sqlSwsetor   = mysql_query("SELECT sum(a.jumlah) as jmlsimpan FROM tabel_simpanan a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.jenis_simpanan = 'Simpanan Wajib' and a.jenis = 'setor' ORDER BY a.kode_simpanan ASC") or die (mysql_error());
$rowSwsetor   = mysql_fetch_array($sqlSwsetor);

$sqlSwtarik   = mysql_query("SELECT sum(a.jumlah) as jmlsimpan FROM tabel_simpanan a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.jenis_simpanan = 'Simpanan Wajib' and a.jenis = 'tarik' ORDER BY a.kode_simpanan ASC") or die (mysql_error());
$rowSwtarik   = mysql_fetch_array($sqlSwtarik);

$sisaSw = $rowSwsetor['jmlsimpan']-$rowSwtarik['jmlsimpan'];

$sqlSpsetor      = mysql_query("SELECT sum(a.jumlah) as jmlsimpan FROM tabel_simpanan a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.jenis_simpanan = 'Simpanan Pokok' and a.jenis = 'setor' ORDER BY a.kode_simpanan ASC") or die (mysql_error());
$rowSpsetor   = mysql_fetch_array($sqlSpsetor);

$sqlSptarik      = mysql_query("SELECT sum(a.jumlah) as jmlsimpan FROM tabel_simpanan a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.jenis_simpanan = 'Simpanan Pokok' and a.jenis = 'tarik' ORDER BY a.kode_simpanan ASC") or die (mysql_error());
$rowSptarik   = mysql_fetch_array($sqlSptarik);

$sisaSp = $rowSpsetor['jmlsimpan']-$rowSptarik['jmlsimpan'];

$sqlSsetor      = mysql_query("SELECT sum(a.jumlah) as jmlsimpan FROM tabel_simpanan a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.jenis_simpanan = 'Simpanan Sukarela' and a.jenis= 'setor' ORDER BY a.kode_simpanan ASC") or die (mysql_error());
$rowSsetor   = mysql_fetch_array($sqlSsetor);

$sqlSstarik      = mysql_query("SELECT sum(a.jumlah) as jmlsimpan FROM tabel_simpanan a, tabel_anggota b Where a.no_anggota = b.no_anggota and b.status = 'Aktif' and a.jenis_simpanan = 'Simpanan Sukarela' and a.jenis= 'tarik' ORDER BY a.kode_simpanan ASC") or die (mysql_error());
$rowSstarik   = mysql_fetch_array($sqlSstarik);

$sisaSs = $rowSsetor['jmlsimpan'] - $rowSstarik['jmlsimpan'];

$pinj = mysql_query("select * from tabel_pinjaman a, tabel_angsuran b Where a.no_anggota = b.no_anggota ");
$hpinj = mysql_fetch_array($pinj);


$sisapinjaman = $rowPin['jmlpinj'] - $rowPin['jmlangs'];

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
                <div class="row">
                    <div class="col-md-12">
                     <h2>Beranda Aplikasi Simpan Pinjam </h2>   
                 <!--       <h5>Welcome <strong><?php echo $_SESSION["username"];?></strong> </h5>  -->
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                 <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-6">           
                			<div class="panel panel-back noti-box">
                                <center>
                                <div class="text-box" >
                                    <a  href="?anggota">
                                        <span id="thing" class="icon-box bg-color-red set-icon" id="thing" ><i class="fa fa-users"></i></span>
                                    </a>
                                    <a href="?anggota">
                                        <p class="main-text"><?php echo $hitungAng; ?> Data <br /> Anggota</p>
                                    </a>
                                    <br>
                                </div>
                                </center>
                             </div>
                		     </div>
                            <div class="col-md-4 col-sm-6 col-xs-6">           
                			<div class="panel panel-back noti-box">
                                <center>
                                <div class="text-box" >
                                    <a href="?SetoranManual">
                                        <span id="thing" class="icon-box bg-color-green set-icon"><i class="fa fa-inbox"></i></span>
                                    </a>
                                
                                    <a  href="?SetoranManual">
                                        <p class="main-text">Total nominal simpanan </br><?php echo 'Rp. ' . number_format( $Simpanan, 0 , '' , '.' ); ?>  </p>
                                    </a>
                                </div>
                                </center>
                             </div>
                		     </div>
                            
                            <div class="col-md-4 col-sm-6 col-xs-6">           
                			<div class="panel panel-back noti-box">
                                <center>
                                <div class="text-box" >
                                    <a href="?anggota">
                                        <span id="thing" class="icon-box bg-color-blue set-icon"><i class="glyphicon glyphicon-share-alt"></i></span>
                                    </a>
                                    <a href="?anggota">
                                        <p class="main-text"><?php echo $hitungPer; ?> Data Anggota  </br> Yang Meminjam <br />Koperasi</p>
                                    </a>
                                </div>
                                </center>
                             </div>
                		     </div>
        			</div> 
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-6"> 
                                    <div class="panel panel-back noti-box">
                                    <center>          
                                    <div class="text-box" >
                                        <a href="?pinjaman">
                                            <span id="thing" class="icon-box bg-color-brown set-icon"><i class="fa fa-external-link-square "></i></span>
                                        </a>    
                                        <a href="?pinjaman">
                                            <p class="main-text">Total nominal </br> pinjaman pokok<br /><?php echo 'Rp. ' . number_format( $rowPin["jumlah"], 0 , '' , '.' ); ?>  </p>
                                        </a>
                                    </div>
                                     </center>
                                     </div>
                    		     </div>
                                  <div class="col-md-4 col-sm-6 col-xs-6"> 
                                        <div class="panel panel-back noti-box">
                                            <center>  
                                            <div class="text-box" >
                                            <a href="#">
                                                <span id="thing" class="icon-box bg-color-green set-icon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                            </a>
                                            <a href="#">
                                                <p class="main-text">Total Nominal <br />Sisa Tunggakan <br /><?php echo 'Rp. '.number_format($sisapinjaman,0,'','.'); ?></p>
                                            </a>
                                                <br />
                                           
                                            </div>
                                            </center>   
                                         </div>
                                         
                        		     </div> 
                                      <div class="col-md-4 col-sm-6 col-xs-6"> 
                                        <div class="panel panel-back noti-box">
                                        <center>          
                                        <div class="text-box" >
                                            <a href="?pinjaman">
                                            <span id="thing" class="icon-box bg-color-blue set-icon"><i class="glyphicon glyphicon-tree-deciduous"></i></span>
                                            </a>
                                            <a href="?pinjaman">
                                                <p class="main-text">Total Nominal <br />Bunga Pinjaman Berjalan <br /><?php echo 'Rp. '.number_format($hitungAngsbunga['bunga'],0,'','.'); ?></p>
                                            </a>
                                                <br />
                                           
                                            </div>
                                         </center>
                                         </div>
                        		     </div> 
                           </div>
                           <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-6"> 
                                        <div class="panel panel-back noti-box">
                                        <center>          
                                        <div class="text-box" >
                                            <a href="?SetoranManual=simpanan-pokok">
                                                <span id="thing" class="icon-box bg-color-green set-icon"><i class="fa fa-outdent"></i></span>
                                            </a>
                                            <a href="?SetoranManual=simpanan-pokok">
                                                <p class="main-text">Total Nominal <br />Simpanan Pokok<br /><?php echo 'Rp. '.number_format($sisaSp,0,'','.'); ?></p>
                                            </a>
                                        </div>
                                         </center>
                                         </div>
                        		     </div> 
                        <div class="col-md-4 col-sm-6 col-xs-6">
                        			<div class="panel panel-back noti-box">
                                    <center>          
                                    <div class="text-box" >
                                        <a href="?SetoranManual=simpanan-wajib">
                                            <span id="thing" class="icon-box bg-color-brown set-icon"><i class="fa fa-align-justify"></i></span>
                                        </a>
                                        
                                        <a href="?SetoranManual=simpanan-wajib">
                                            <p class="main-text">Total Nominal </br> Simpanan Wajib <br /><?php echo 'Rp. ' . number_format( $sisaSw, 0 , '' , '.' ); ?>  </p>
                                        </a>
                                     </div>
                                     </center>
                                     </div>
                    		     </div>
                                  
                                      <div class="col-md-4 col-sm-6 col-xs-6"> 
                                        <div class="panel panel-back noti-box">
                                        <center>
                                        <div class="text-box" >
                                            <a href="?SetoranManual=simpanan-sukarela">
                                                <span id="thing" class="icon-box bg-color-blue set-icon"><i class="fa fa-align-right"></i></span>
                                            </a>
                                            <a href="?SetoranManual=simpanan-sukarela">
                                                <p class="main-text">Total Nominal <br />Simpanan Sukarela <br /><?php echo 'Rp. '.number_format($sisaSs,0,'','.'); ?></p>
                                            </a>
                                        </div>
                                         </center>
                                         </div>
                        		     </div> 
                           </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-12 col-xs-12 " style="height: 50%;">
                    <h3 style="margin: 5px 0;">Berita KP3</h3>
                    <hr style="width: 80%;" />
                    <div class="newsheadline">
                   	     <ul>
                            <?php
                            if(mysql_num_rows($sqlnews) > 0){
       				         
                            while($rownews=mysql_fetch_array($sqlnews))
       				         {
       				             ?>
                            
                        		<li>
                                    <p><a href="?detail-berita=<?php echo $rownews['id_berita']; ?>"><?php echo $rownews['judul'];?></a></p>
                                    <span><?php echo tglindonesia($rownews['datetime']);?></span>
                                    <p class="text-isi"><?php echo $rownews['sinopsis'];?></p>
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