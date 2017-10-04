<?php

    header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Cache-control: private");
	header("Content-Type: application/vnd.ms-excel; name='excel'");
	header("Content-disposition: attachment; filename=laporanmediachanneling.xls");
  
    include "../../config/koneksi.php";
    include "../../config/utility.php";
    //variable dari laporan media
    $tglmulai   = strip_tags(date('Y-m-d', strtotime($_GET["tglmulai"])));
    $tglsls     = strip_tags(date('Y-m-d', strtotime($_GET["tglsls"])));
    $unit2      = strip_tags(addslashes($_GET["unit"]));
    $subject2   = strip_tags(addslashes($_GET["sbj"]));
    $aset2      = strip_tags(addslashes($_GET["aset"]));
    $jenis2     = strip_tags(addslashes($_GET["jenis"]));
    
    $qunit      = "SELECT * FROM unit WHERE kodeunit='$unit2'";
    $runit      = odbc_exec($koneksi, $qunit);
    $unitD      = odbc_result($runit,"unit");
    
    $qsubject   = "SELECT * FROM subject WHERE kodesubject='$subject2'";
    $rsubject   = odbc_exec($koneksi, $qsubject);
    $subjectD   = odbc_result($rsubject,"subject");
    
    $qaset      = "SELECT * FROM asetpengetahuan WHERE kodeaset='$aset2'";
    $raset      = odbc_exec($koneksi, $qaset);
    $asetD      = odbc_result($raset,"asetpengetahuan");
    
    if (! $aset2==0){ $queryaset= " AND kodeaset = '".$aset2."'"; } 
    if (! $unit2==0){ $queryunit= " AND kodeunit = '".$unit2."'"; }
    if (! $subject2==0){ $querysubject= " AND kodesubjectparent = '".$subject2."'"; }
    if (! $jenis2==0){ $queryjenis= " AND kategori = '".$jenis2."'"; }
    
    $media_cari = "SELECT * FROM media WHERE tglinput BETWEEN '$tglmulai' AND '$tglsls' $queryunit  $querysubject
         $queryaset  $queryjenis";
    $RCari = odbc_exec($koneksi, $media_cari);
    $idmedia1=odbc_result($RCari,"idmedia");
?>
<style>
    .table{width: 100%;}
    .warning{background: #ccc;}
    tr{margin: 0 3px;}
    
    .table-title th{margin: 0 3px;}
</style>
<h3>Laporan Media Channeling</h3>
<strong>Berdasarkan :</strong><br />
<strong>Periode : </strong><i><?php echo tglindonesia($tglmulai); ?> s/d <?php echo tglindonesia($tglsls); ?></i><br />
<strong>Unit : </strong> <i><?php if (! $unit2==0){ echo "$unitD";}else{echo "semua";} ?></i><br />
<strong>Subject : </strong><i><?php if (! $aset2==0){ echo "$subjectD";}else{echo "semua";} ?></i><br />
<strong>Asset : </strong><i><?php if (! $aset2==0){ echo "$asetD";}else{echo "semua";} ?></i><br />
<strong>Jenis : </strong><i><?php if (! $jenis2==0){ echo "$jenis2";}else{echo "semua";} ?></i>

<table border="1" class="table table-striped">
    <thead>
        <tr class="warning">
            <th width="3%">No</th>
            <th width="25%">Judul Media</th>
            <th width="20%">Tanggal Upload</th>
            <th width="7%">Dilihat</th>
            <th width="12%">Like / Dislike</th>
            <th width="10%">Rating</th>
            <th width="10%">Status</th> 
        </tr>
    </thead>
    <tbody>
    <?php 
    $no=1;     
    if(odbc_num_rows($RCari)>0){
        while (odbc_fetch_row($RCari)){
        $kd=odbc_result($RCari,"kodemedia");
        $judulmedia=odbc_result($RCari,"judulmedia");
        $aspen=odbc_result($RCari,"asetpengetahuan");
        $subject=odbc_result($RCari,"subject");
        $tglinput=odbc_result($RCari,"tglinput");
        $jmlview=odbc_result($RCari,"jmlview");
        $status=odbc_result($RCari,"status");
        $idmedia=odbc_result($RCari,"idmedia");
    ?>
    <tr><td><?php echo $no; ?></td>
        <td><?php echo strtoupper($judulmedia); ?></td>
        <td><?php echo tglindonesia($tglinput); ?></td>
        <td><?php echo $jmlview; ?> X</td>
        <td>
            <?php
            $likequery ="select COUNT(statuslike) as jmllike FROM likedislike WHERE kodemedia='$kd' AND statuslike='1'";
            $rlike = odbc_exec($koneksi, $likequery);
            $jmllike=odbc_result($rlike,"jmllike");
            ?> 
            <?php echo $jmllike; ?> Like 
            <?php
            $dislikequery ="select COUNT(statuslike) as jmllike FROM likedislike WHERE kodemedia='$kd' AND statuslike='0'";
            $disrlike = odbc_exec($koneksi, $dislikequery);
            $jmldislike=odbc_result($disrlike,"jmllike");
            ?> 
             <?php echo $jmldislike; ?> Dislike
           </td>
        <td>
        <?php
        $jmlrating ="SELECT COUNT(rating) as jmlrat FROM jmlrating WHERE idmedia='$idmedia'";
        $Rrat = odbc_exec($koneksi, $jmlrating);
        $jmlrat=odbc_result($Rrat,"jmlrat");
        ?> 
        <?php echo $jmlrat; ?> rating</td>
        <td>
        <?php 
        if($status=='reject'){
            echo "<p class='bg-danger status text-warning'>".strtoupper($status)."</p>";
        }else if($status=='pending'){
            echo "<p class='bg-warning status text-danger'>".strtoupper($status)."</p>";
        }else if($status=='approve'){
            echo "<p class='bg-primary status text-info'>".strtoupper($status)."</p>";
        }else if($status=='return'){
            echo "<p class='bg-success status text-warning'>".strtoupper($status)."</p>";
        }else if($status=='hide'){
            echo "<p class='bg-success status text-warning' style='color:#fff; background-color:#D4000C;'>".strtoupper($status)."</p>";
        }
        ?>
            </td>
    </tr>
    <?php $no++; } }else{?>
        <tr>
            <td colspan="9">Media tidak tersedia..</td>
        </tr>
    <?php } ?>
    </tbody>
</table>