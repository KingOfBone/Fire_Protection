<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body style="font-family:draft; font-size:21px">
<?php
	
		include_once "../../librari/inc.koneksi.php";
	function tgl_eng_to_ind($tgl) {
	$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4);
	return $tgl_ind;
}
		
		$sqlinvoice = "SELECT * from pinjaman where nopinjaman = '".$_GET['noinvoice']."' ";
		$qryinvoice = mysql_query($sqlinvoice, $koneksi) or die ("Gagal berita");
		$datainvoice = mysql_fetch_array($qryinvoice);
        $peng = "select * from pengembalian where nopinjaman ='".$_GET['noinvoice']."' and angsuranke='".$_GET['ke']."'";
        $hutang= mysql_query("select sum(nilai) as total from pengembalian where nopinjaman ='".$_GET['noinvoice']."'");
        $hhutang = mysql_fetch_array($hutang);
        $qpeng = mysql_query($peng,$koneksi);
        $hpeng = mysql_fetch_array($qpeng);
        $sisa=$datainvoice['totalbayar']-$hhutang['total'];
?>

<table width="100%" border="0">
  <tr>
    <td width="2%" rowspan="8"><img src="../../images/pemisah.png" width="20" height="1" border="0"></td>
    <td height="103" colspan="4" align="center"><font style="font-size:32px; font-weight:bold">KOPERASI PEGAWAI PLN PUSAT</font><br>
    Jl. Trunojoyo Blok M1 / 136 Keb. Baru - Jakarta Selatan - 12160 <br>
    Telp : (0217261122 Ext. 1760 / 1761)</td>
    <td width="3%" rowspan="8"><img src="../../images/pemisah.png" width="30" height="1" border="0"></td>
  </tr>
  <tr>
    <td width="21%" height="2" valign="top"><b>KP3 TRAVEL</b> </td>
    <td align="right" valign="top"><img src="../../images/pemisah.png" width="250" height="1" border="0"></td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td width="21%" height="4" valign="top">Tanggal</td>
    <td width="12%"  valign="top"><?php echo tgl_eng_to_ind($datainvoice['tgltransaksi']); ?></td>
    <td colspan="2">NO PINJAMAN.  <?php echo $datainvoice['nopinjaman']; ?><img src="../../images/pemisah.png" width="400" height="1" border="0"></td>
  </tr>
  
  <tr>
    <td width="21%" height="10" valign="top">Nama Pelanggan</td>
    <td ><?php $pel="select * from pelanggan_pinjaman where kodepelanggan ='".$datainvoice[kodepelanggan]."'";
          $qpel = mysql_query($pel);
        $hpel = mysql_fetch_array($qpel);
            
            echo $hpel['nama']; ?></td>
    <td><?php echo "No Telp : ".$hpel['notelp'];?></td> 

  </tr>

  
  <tr><td  colspan="4">
    <table width="100%" >
     <tr>
        <td height="3" colspan="5" bgcolor="#666666"></td>
        </tr>
      <tr>
        <td width="24%"><b>Angsuran Ke</b> <img src="../../images/pemisah.png" width="250" height="1" border="0"></td>
        <td><?php echo $hpeng['angsuranke'];?></td>
        </tr>
        
        <tr>
        <td width="42%"><b>Besaran Bayar </b> <img src="../../images/pemisah.png" width="400" height="1" border="0"></td>
        <td>Rp <?php echo number_format($hpeng['nilai'],0,'.','.');?></td>
        </tr>
        <tr>
        <td width="16%" height="16"><b>Sisa Hutang</b> <img src="../../images/pemisah.png" width="170" height="1" border="0"></td>
        <td>Rp <?php echo number_format($sisa,0,'.','.');?></td>
          </tr>
    
        <tr>
        <td colspan="2"><?php	include_once "../terbilang.php";
		$terbilang = strtoupper(toTerbilang($sisa));
		echo "Terbilang : <b>{$terbilang} RUPIAH</b>";?></td>
        </tr>
       <tr>
        <td height="3" colspan="5" bgcolor="#666666"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="16" colspan="4">&nbsp;</td>
  </tr>
  <tr><td height="88" colspan="3" valign="top">
    <table width="97%" >
      <tr>
        <td>Pembayaran dapat ditransfer melalui<img src="../../images/pemisah.png" width="50" height="1" border="0"><br>
        Bnk BNI a/n KP3 Travel<br>
        BNI Cabang Melawai Raya<br>
        No. Rekening : 0185.115.704  </td>
      </tr>
	  <tr>
		<td></td>
	  </tr>
	 
    </table></td>
    <td colspan="1" ><table width="96%">
      <tr>
        <td valign="top"><table width="100%" >
          <tr>
            <td width="50%" >Dibuat Oleh,</td>
            <td width="50%" align="right">Diterima Oleh,</td>
          </tr>
          <tr>
            <td height="46"><br />
                <br />   <br />
              (
              <?php 
			
			 $sqlinputby = "SELECT * FROM login where kodelogin = '".$datainvoice['inputby']."' ";
 $qryinputby = mysql_query($sqlinputby, $koneksi) or die ("Gagal query");
 $datainputby = mysql_fetch_array($qryinputby);
 			echo $datainputby['nama']; ?>
              )</td>
            <td align="right"><br />
                <br /><br />
              (<img src="../../images/pemisah.png" width="100" height="1" border="0">)</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
