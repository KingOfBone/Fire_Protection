<?php ob_start(); ?>
<?php

	session_start();

//include "../../librari/inc.koneksi.php";
//include "../librari/inc.session.php";
include "../../librari/inc.librari1.php";
include "../../config/koneksi.php";

if ($_GET['act']=='excel') {

	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Cache-control: private");
	header("Content-Type: application/vnd.ms-excel; name='excel'");
	header("Content-disposition: attachment; filename=laporaneo.xls");

}
else
{
echo '
<script>

	window.print();

</script>';
}

?>

<style type="text/css">

.style4 {font-family: Arial !important; font-size:18px !important;}
.style9 {font-family: Arial !important; font-size:12px !important; background-color:#99bbff !important; font-weight:bold !important; text-align:center !important; vertical-align: middle !important; width:auto !important; }
.style1 {font-family: Arial !important; font-size:12px !important;}
.style2 {font-family: Arial !important; font-size:12px !important; text-align: center !important; background-color: #ffd9b3 !important;}

</style>
<title>Laporan Emergency Outage</title>
<body>
    <table width="98%"  border="0">
        <tr>
            <td>
                <fieldset>
                    <center>
						<legend class="style4">
							<b>DAFTAR REALISASI EMERGENCY OUTAGE <br> TRAFO DISTRIBUSI DAN KONSUMEN TEGANGAN TINGGI <br>
							<?php
								if($_SESSION["jenisuser"]=="gi")
								{
									$sql4 = mysql_query("SELECT master.gi.* FROM master.gi WHERE master.gi.kodegi = $_SESSION[kodegi]") or die(mysql_error());
									$row4 =  mysql_fetch_array($sql4);
									echo $row4['namagi'];
								}
								else if($_SESSION["jenisuser"]=="app")
								{
									$sql4 = mysql_query("SELECT master.app.* FROM master.app WHERE master.app.kodeapp = $_SESSION[kodeapp]") or die(mysql_error());
									$row4 = mysql_fetch_array($sql4);
									echo $row4['namaapp'];
								}
							?> <br> PERIODE : <?php echo tgl_eng_to_ind($_GET['tglawal']); ?>  s/d  <?php echo tgl_eng_to_ind($_GET['tglakhir']); ?></b>&nbsp;</legend></center>
                    <br>

                    <table width="100%" border="1" cellpadding="1" cellspacing="0"  bordercolordark="#000000"  bordercolorlight="#FFFFFF">
                        <tr class="style9">
                            <td rowspan="2">No</td>
                            <td rowspan="2">Gardu Induk</td>
                            <td rowspan="2">No. Trafo</td>
                            <td>pic</td>
                            <td colspan="2">Mulai</td>
                            <td colspan="2">Normal</td>
                            <td colspan="2">Durasi Padam</td>
                            <td rowspan="2">Keterangan</td>
                        </tr>
                        <tr  class="style9">
                            <td>TJBT / NON TJBT</td>
                            <td>Tanggal</td>
                            <td>Jam</td>
                            <td>Tanggal</td>
                            <td>Jam</td>
                            <td>Jam:Menit</td>
                            <td>Jam</td>
                        </tr>
                        <?php
                            $no=0  ;
							$e=0;
                            $tglawal    = tgl_eng_to_ind1($_GET['tglawal']);
                            $tglakhir   = tgl_eng_to_ind1($_GET['tglakhir']);

                            if($_SESSION["jenisuser"]=="gi"){
								$sql = mysql_query("SELECT tsa.eo.*, master.gi.*, master.trafo.*, (TIMEDIFF(tsa.eo.normal,tsa.eo.mulai)) as jumlahjam FROM tsa.eo INNER JOIN master.gi ON tsa.eo.kodegi = master.gi.kodegi INNER JOIN master.trafo ON tsa.eo.kodetrafo = master.trafo.kodetrafo WHERE tsa.eo.kodegi = $_SESSION[kodegi] AND tsa.eo.mulai >= '$tglawal' AND tsa.eo.mulai <= '$tglakhir' ORDER BY tsa.eo.mulai DESC") or die (mysql_error());
							}
							else if($_SESSION["jenisuser"]=="app"){
								$sql = mysql_query("SELECT tsa.eo.*, master.gi.*, master.trafo.*, (TIMEDIFF(tsa.eo.normal,tsa.eo.mulai)) as jumlahjam FROM tsa.eo INNER JOIN master.gi ON tsa.eo.kodegi = master.gi.kodegi INNER JOIN master.trafo ON tsa.eo.kodetrafo = master.trafo.kodetrafo WHERE tsa.eo.kodeapp = $_SESSION[kodeapp] AND tsa.eo.mulai >= '$tglawal' AND tsa.eo.mulai <= '$tglakhir' ORDER BY tsa.eo.mulai DESC") or die (mysql_error());
							}
                            $ada_cek = mysql_num_rows($sql);
                            $d = 0;
                            while ($data = mysql_fetch_array($sql)) {
                                $no++;
                        ?>

                                <tr class="style1">
                                    <td align="center">&nbsp;<?php echo $no; ?></td>
                                    <td><?php echo $data['namagi'];?></td>
                                    <td align="center"><?php echo $data['nomortrafo'];?></td>
                                    <td align="center"><?php echo $data['pic'];?></td>
                                    <td align="center"><?php echo tgl_eng_to_ind($data['mulai']); ?></td>
                                    <td align="center"><?php echo waktu_eng_to_ind($data['mulai']); ?></td>
                                    <td align="center"><?php echo tgl_eng_to_ind($data['normal']); ?></td>
                                    <td align="center"><?php echo waktu_eng_to_ind($data['normal']); ?></td>
                                    <td align="center"><?php echo waktu_eng_to_ind1($data['jumlahjam']);?></td>
                                    <td align="center">
                                        <?php
                                            $sql1 = mysql_query("SELECT HOUR('$data[jumlahjam]') as jam, MINUTE('$data[jumlahjam]') as menit") or die(mysql_error());
                                            $row1 = mysql_fetch_array($sql1);
                                            $a = $row1['jam'];
                                            $b = $row1['menit'];
                                            echo $c = number_format((($a*60) + $b)/60,2);

											if ($data['pic'] == 'TJBT') {
												$sql5 = mysql_query("SELECT HOUR('$data[jumlahjam]') as jam, MINUTE('$data[jumlahjam]') as menit") or die(mysql_error());
	                                            $row5 = mysql_fetch_array($sql5);
	                                            $a1 = $row5['jam'];
	                                            $b1 = $row5['menit'];
	                                            $d = number_format((($a1*60) + $b1)/60,2);
											}
											else {
												$d = 0;
											}

											$e += number_format($d,2);
                                        ?>
                                    </td>
                                    <td align="center"><?php echo $data['keterangan'];?></td>
                                </tr>
                        <?php } ?>
                        <tr class="style2">
                            <td colspan="8"><b>Total Emergency Outage (EO)
								<?php
									if($_SESSION["jenisuser"]=="gi")
									{
										$sql2 = mysql_query("SELECT master.gi.* FROM master.gi WHERE master.gi.kodegi = $_SESSION[kodegi]") or die(mysql_error());
										$row2 =  mysql_fetch_array($sql2);
										echo $row2['namagi'];
									}
									else if($_SESSION["jenisuser"]=="app")
									{
										$sql2 = mysql_query("SELECT master.app.* FROM master.app WHERE master.app.kodeapp = $_SESSION[kodeapp]") or die(mysql_error());
										$row2 = mysql_fetch_array($sql2);
										echo $row2['namaapp'];
									}
								?></b></td>
                            <td><b><?php echo $e; ?></b></td>
                            <td><b>Jam</b></td>
                            <td><b></b></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
            </td>
        </tr>
    </table>
</body>
<?php ob_flush();  ?>
