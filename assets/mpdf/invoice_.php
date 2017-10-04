<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body style="font-family:verdana; font-size:19px">
<?php
	
		include_once "../../librari/inc.koneksi.php";
	function tgl_eng_to_ind($tgl) {
	$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4);
	return $tgl_ind;
}
	
		
		$sqlinvoice = "SELECT
`penjualanheader`.`kodepelanggan`,`penjualanheader`.`multirute`,`penjualanheader`.`biayaadmin`,`pelanggan`.`nama`,`penjualanheader`.`tgltransaksi`,`penjualanheader`.`inputby`,`penjualanheader`.`statuspembayaran`, `penjualandetail`.`kodeairline`, `penjualandetail`.`notiket`, `penjualandetail`.`kodeasal`,`penjualandetail`.`kodetujuan`,`penjualandetail`.`waktuberangkat`, `penjualandetail`.`harga`, `penjualandetail`.`pp`, `penjualanheader`.`noinvoice`,`penjualandetail`.`kodepenjualandetail`, `penjualandetail`.`namapenumpang`,`penjualandetail`.`kodepenerbangan`,`asal`.`namaairline`,`airport`.`namaairport`,`airport`.`singkatan` as singkatan,`airport`.`kota`,`tujuan`.`namaairport` as airporttujuan,`tujuan`.`singkatan` as singkatantujuan,`tujuan`.`kota`  as kotatujuan
FROM
`penjualandetail`
Inner Join `penjualanheader` ON `penjualandetail`.`noinvoice` = `penjualanheader`.`noinvoice`
Inner Join `pelanggan` ON `pelanggan`.`kodepelanggan` = `penjualanheader`.`kodepelanggan`
Inner Join `airline` AS `asal` ON `asal`.`kodeairline` = `penjualandetail`.`kodeairline`
Inner Join `airport` ON `airport`.`kodeairport` = `penjualandetail`.`kodeasal`
Inner Join `airport` AS `tujuan` ON `tujuan`.`kodeairport` = `penjualandetail`.`kodetujuan`
 where `penjualanheader`.`noinvoice` = '".$_GET['noinvoice']."' ";
		$qryinvoice = mysql_query($sqlinvoice, $koneksi) or die ("Gagal berita");
		$datainvoice = mysql_fetch_array($qryinvoice);

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
    <td width="20%" height="2" valign="top"><b>KP3 TRAVEL</b> </td>
    <td align="right" valign="top"><img src="../../images/pemisah.png" width="250" height="1" border="0"></td>
    <td>&nbsp;</td>
    <td><b><?php echo strtoupper($datainvoice['statuspembayaran']); ?></b></td>
  </tr>
  <tr>
    <td width="9%" height="4" valign="top">Tanggal</td>
    <td width="21%"  valign="top"><?php echo tgl_eng_to_ind($datainvoice['tgltransaksi']); ?></td>
    <td colspan="2" align="center">NO INVOICE.  <?php echo $datainvoice['noinvoice']; ?><img src="../../images/pemisah.png" width="400" height="1" border="0"></td>
  </tr>
  
  <tr>
    <td width="9%" height="10" valign="top">Nama Pelanggan</td>
    <td ><?php echo $datainvoice['nama'];  ?></td>
    <td></td>
	  <td>
	<?php 
	if ($datainvoice['multirute']=='ya') {
			echo "Multi-Rute";
		}
	?>
  </td>
    <td width="2%"><?php //  $duedate = date("Y-m-d H:i:s", strtotime("+7 days ")); echo tgl_eng_to_ind($duedate); ?></td>
  </tr>

  <tr>
    <td width="9%" height="22" valign="top">&nbsp;</td>
    <td align="right" valign="top"> </td>
    <td width="55%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
  </tr>
  
  <tr><td  colspan="4">
    <table width="100%" >
     <tr>
        <td height="3" colspan="5" bgcolor="#666666"></td>
        </tr>
      <tr>
        <td width="4%"><b>No</b> <img src="../../images/pemisah.png" width="40" height="1" border="0"></td>
        <td width="24%"><b>Nama Penumpang</b> <img src="../../images/pemisah.png" width="250" height="1" border="0"></td>
        <td width="42%"><b>Rute</b> <img src="../../images/pemisah.png" width="400" height="1" border="0"></td>
        <td width="16%" height="16"><b>Nomor Tiket</b> <img src="../../images/pemisah.png" width="170" height="1" border="0"></td>
        <td width="14%" align="right"><img src="../../images/pemisah.png" width="150" height="1" border="0"><b>Harga</b>  </td>
      </tr><?php   
	   $qryinvoice = mysql_query($sqlinvoice, $koneksi) or die ("Gagal query");
	   while ($dataq = mysql_fetch_array($qryinvoice)) {
  $no++;
  ?>
      <tr>
        <td valign="top"><?php echo $no; ?>.</td>
        <td valign="top"><?php echo $dataq['namapenumpang']; ?> </td>
        <td valign="top"><?php echo $dataq['singkatan']; ?>  -  <?php echo $dataq['singkatantujuan']; ?> 
		<?php if ($dataq['pp']=='ya') {
		echo "- ".$dataq['singkatan']." (PP)";
		} ?>
		<?php echo $dataq['kodepenerbangan']; ?> <?php echo tgl_eng_to_ind($dataq['waktuberangkat']); ?></td>
        <td height="20" valign="top">
       <?php echo $dataq['notiket']; ?>   </td>
          <td align="right" valign="top"><?php 
	if ($dataq['harga']!='00') {
			echo "Rp ".number_format($dataq['harga'], 0, '.', '.');
		}
	?></td>
      </tr> 
 <tr>
        <td height="3" colspan="4" ></td>
        </tr>
		<tr><td></td>
        <td height="3" colspan="3" >Biaya Admin</td><td align="right">Rp <?php echo number_format($datainvoice['biayaadmin'], 0, '.', '.');?></td>
        </tr>	  <?php
  }
  ?> 
      <tr>
		 <td></td><td></td><td></td>
         <td align="center"><b>Total</b></td>
        <td align="right"><?php
        
		$sqltot = "SELECT sum(`penjualandetail`.`harga`) as total
FROM
`penjualandetail`
Inner Join `penjualanheader` ON `penjualandetail`.`noinvoice` = `penjualanheader`.`noinvoice`
Inner Join `pelanggan` ON `pelanggan`.`kodepelanggan` = `penjualanheader`.`kodepelanggan`
Inner Join `airline` AS `asal` ON `asal`.`kodeairline` = `penjualandetail`.`kodeairline`
Inner Join `airport` ON `airport`.`kodeairport` = `penjualandetail`.`kodeasal`
Inner Join `airport` AS `tujuan` ON `tujuan`.`kodeairport` = `penjualandetail`.`kodetujuan`
 where `penjualanheader`.`noinvoice` = '".$_GET['noinvoice']."' ";
		$qrytot = mysql_query($sqltot, $koneksi) or die ("Gagal berita");
		$datatot = mysql_fetch_array($qrytot);

?><b>Rp <?php $total=$datatot['total'] + $datainvoice['biayaadmin']; echo number_format($total, 0, '.', '.');?></b>		</td>
      </tr>
      <tr>
        <td colspan="5" align="left"><?php	include_once "../terbilang.php";
		$terbilang = strtoupper(toTerbilang($datatot['total']));
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
  <tr>
    <td height="16" colspan="4">&nbsp;</td>
  </tr>
  
  <tr>
    <td height="16" colspan="4">&nbsp;</td>
  </tr>
  <tr><td height="88" colspan="3" valign="top">
    <table width="110%" >
      <tr><td width="7%"></td>
        <td width="93%">Pembayaran dapat ditransfer melalui<img src="../../images/pemisah.png" width="50" height="1" border="0"><br>
        Bnk BNI a/n KP3 Travel<br>
        BNI Cabang Melawai Raya<br>
        No. Rekening : 0185.115.704  </td>
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
                <br />
              (<img src="../../images/pemisah.png" width="100" height="1" border="0">)</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
