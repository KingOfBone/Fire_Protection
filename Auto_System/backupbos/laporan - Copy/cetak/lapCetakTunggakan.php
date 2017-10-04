<?php
include "../../../config/koneksi.php";
include "../../../config/utility.php";

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Cache-control: private");
header("Content-Type: application/vnd.ms-excel; name='excel'");
header("Content-disposition: attachment; filename=laporanperanggota.xls");

    $key     = $_GET['keycetak1'] ? $_GET['keycetak1']: $_GET['keycetak1'];
    $key2     = $_GET['keycetak2'] ? $_GET['keycetak2'] : $_GET['keycetak2'];
    
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

$jmltarik = mysql_query("SELECT SUM(tabel_angsuran.angsuran_bayar) as jumlah
FROM
tabel_anggota ,
tabel_angsuran
WHERE tabel_angsuran.status_angsuran='Belum Lunas'
 $q ") or die (mysql_error());
    
    $jml2 = mysql_fetch_array($jmltarik);
?>
<h2>Laporan Simpanan</h2>
<br /><br />
<h3>History Setor Simpanan</h3>
<table border="1" >
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
<br /><br />

