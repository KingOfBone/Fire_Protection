<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body style="font-family:draft; font-size:21px">
<?php
	
	include_once "../../config/koneksi.php";
	function tgl_eng_to_ind($tgl) {
	$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4);
	return $tgl_ind;
}
	
		
		$sqlinvoice = "SELECT * from tabel_pinjaman a, tabel_anggota b where a.no_anggota = b.no_anggota and a.kode_pinjaman = '".$_GET['noinvoice']."'";
		$qryinvoice = mysql_query($sqlinvoice, $koneksimysql) or die ("Gagal berita");
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
    <td width="21%" height="2" valign="top" colspan="3"><b>KP3 Simpan Pinjam</b> </td>
    <td align="right" valign="top"><img src="../../images/pemisah.png" width="250" height="1" border="0"></td>
    <td>&nbsp;</td>
   
  </tr>
  <tr>
    <td width="21%" height="4" valign="top">Tanggal</td>
    <td width="12%"  valign="top"><?php echo tgl_eng_to_ind($datainvoice['tgl_pinjaman']); ?></td>
    
  </tr>
  
  <tr>
    <td width="21%" height="10" valign="top">Nama Anggota</td>
    <td valign="top" colspan="2"><?php echo $datainvoice['nama_anggota']; ?></td>
    <td></td>    

  </tr>
  <tr>
    <td width="21%" height="10" valign="top">Jumlah Pinjaman</td>
    <td valign="top" colspan="2"><?php echo "Rp ".number_format($datainvoice['jumlah_pinjaman'],0,'.','.'); ?></td>
    <td></td>    

  </tr>
  <tr>
    <td width="21%" height="10" valign="top">Bunga Per Bulan</td>
    <td valign="top" colspan="2"><?php echo $datainvoice['bunga']." %"; ?></td>
    <td></td>    

  </tr>
  <tr>
    <td width="21%" height="10" valign="top">Jangka Waktu</td>
    <td valign="top" colspan="2"><?php echo $datainvoice['jangka_waktu']; ?></td>
    <td></td>    

  </tr>
  <br /><br />
    <tr>
    
    <td colspan="3"><h4>Detail Angsuran</h4></td></tr>
          <table width="100%" border="1">
                                    
                                        <tr>
                                            <th width="2%">Bulan</th>
                  						    <th width="17%">Angsuran Bunga </th>
                                            <th width="17%">Angsuran Pokok</th>
                      						<th width="17%">Total Angsuran</th>
                      						<th width="17%">Sisa Pinjaman</th>
                                           
                       					</tr>
                                   
                                    
                                    <?php
                            				$sqlangsuran = mysql_query("select * from tabel_angsuran where no_pinjaman = '".$_GET['noinvoice']."'");
                                     //       $angsuran = mysql_fetch_array($sqlangsuran);
                                            
                                            $bulan = 0;
                                            ?>
                                            <tr>
                                                   
                                                    <td align="center"><?php echo $bulan; ?></td>
                            						<td><?php echo "Rp 0";?></td>
                            						<td><?php echo "Rp 0";?></td>
                            						<td><?php echo "Rp 0";?></td>
                                                    <td><?php echo "Rp ".number_format($datainvoice['jumlah_pinjaman'],0,'.','.');?></td>
                                                    
                            					</tr> 
                                           <?php
                                                
                                            $sisa =   $datainvoice['jumlah_pinjaman'];
                                                  
                                            while ($angsuran = mysql_fetch_array($sqlangsuran)){ 
                                             $bulan2=$angsuran['angsuran_ke'];  
                                            $bunga = $datainvoice['jumlah_pinjaman'] * $datainvoice['bunga']/100;
                                            $angspokok = $angsuran['angsuran_bayar']-$bunga;   
                                              
                                                $sisa = $sisa - $angspokok;
                                                ?>
                                               <tr>
                                                    
                                                    <td align="center"><?php echo $bulan2; ?></td>
                            						<td><?php echo "Rp ".number_format($bunga,0,'.','.');?></td>
                            						<td><?php echo "Rp ".number_format($angspokok,0,'.','.');?></td>
                            						<td><?php echo "Rp ".number_format($angsuran['angsuran_bayar'],0,'.','.');?></td>
                                                    <td><?php echo "Rp ".number_format($sisa,0,'.','.');?></td>
                                                    
                            					</tr>   
                                            <?php
                                            $bulan2++;
                                            }
                                            $totbunga = $bunga * $datainvoice['jangka_waktu'];
                                       //     $totpokok = sum($angspokok);
                                       //     $totangs = sum($angsuran['angsuran_bayar']);
                            
                            				?>
                                             <tr>
                                                    
                                                    <td align="center"><?php echo "Total"; ?></td>
                            						<td><?php echo "Rp ".number_format($totbunga,0,'.','.');?></td>
                            						<td><?php echo "Rp ".number_format($datainvoice['jumlah_pinjaman'],0,'.','.');?></td>
                            						<td><?php   $angs= mysql_fetch_array(mysql_query("select sum(angsuran_bayar) as angs from tabel_angsuran where no_pinjaman='".$_GET['noinvoice']."'"));
                                                                echo "Rp ".number_format($angs['angs'],0,'.','.');?></td>
                                                   
                                                    
                            					</tr> 
                                   
                           
  </table>
  
 
  <tr><td height="88" colspan="3" valign="top">
    <table width="97%" >
      <tr>
        <td>Pembayaran dapat ditransfer melalui<img src="../../images/pemisah.png" width="50" height="1" border="0"><br>
        Bank Mandiri a/n KP3 Simpan Pinjam<br>
        Mandiri Cabang Melawai Raya<br>
        No. Rekening : 100032.000.10100  </td>
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
		/*	
			 $sqlinputby = "SELECT * FROM login where kodelogin = '".$datainvoice['inputby']."' ";
 $qryinputby = mysql_query($sqlinputby, $koneksi) or die ("Gagal query");
 $datainputby = mysql_fetch_array($qryinputby);
 			echo $datainputby['nama']; */ ?>
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
