<?php
include "../../../config/koneksi.php";
include "../../../config/utility.php";

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Cache-control: private");
header("Content-Type: application/vnd.ms-excel; name='excel'");
header("Content-disposition: attachment; filename=laporanpinjaman.xls");

    $key     = $_GET['keycetak1'] ? $_GET['keycetak1'] : $_GET['keycetak1'];
    $key2     = $_GET['keycetak2'] ? $_GET['keycetak2'] : $_GET['keycetak2'];
    //$key3     = $_GET['keycetak3'] ? $_GET['keycetak3'] : $_GET['keycetak3'];
    
    if (! $key=="" && !$key2==""){ $q = " WHERE tabel_pinjaman.tgl_pinjaman >= '$key' and date_sub(tabel_pinjaman.tgl_pinjaman, INTERVAL 1 day) <= '$key2'"; }
    
$pinjam = mysql_query("SELECT tabel_anggota.nama_anggota,tabel_anggota.no_anggota, tabel_anggota.nip,tabel_pinjaman.jangka_waktu, tabel_pinjaman.bunga, 
tabel_pinjaman.status_pinjaman, tabel_pinjaman.sumberdana ,tabel_pinjaman.tgl_pinjaman , tabel_pinjaman.jumlah_pinjaman
FROM tabel_pinjaman INNER JOIN tabel_anggota ON tabel_anggota.no_anggota = tabel_pinjaman.no_anggota $q ") or die (mysql_error());
  
    $jmlpinjam = mysql_query("SELECT SUM(tabel_pinjaman.jumlah_pinjaman) as jumlah FROM tabel_pinjaman 
    INNER JOIN tabel_anggota ON tabel_anggota.no_anggota = tabel_pinjaman.no_anggota $q") or die (mysql_error());
    $pnjm = mysql_fetch_array($jmlpinjam);
?>
<h2>Laporan pinjaman</h2>
<br /><br />
<h3>History pinjaman</h3>
<table border="1" >
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                  						    <th width="10%">No Anggota</th>
                                            <th width="17%">Nama</th>
                      						<th width="13%">Tanggal</th>
                      						<th width="14%">Jumlah</th>
                                            <th width="10%">Jangka waktu</th>
                                            
                                            <th width="13%">Status</th>
                                            <th width="15%">Sumber dana</th>
                       					</tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(mysql_num_rows($pinjam) > 0){
                                    $no=1;
                                    while($rowpinjam=mysql_fetch_array($pinjam))
                    				{
                    				    ?>
                            					<tr>
                                                    <td><?php echo $no; ?></td>
                            						<td><?php echo $rowpinjam['no_anggota'];?></td>
                            						<td><?php echo $rowpinjam['nama_anggota'];?></td>
                            						<td><?php echo tglindonesia($rowpinjam['tgl_pinjaman']);?></td>
                                                    <td><?php echo 'Rp. ' . number_format( $rowpinjam['jumlah_pinjaman'], 0 , '' , '.' );?></td>
                                                    <td><?php echo $rowpinjam['jangka_waktu'];?></td>
                                                    
                                                    <td><?php echo $rowpinjam['status_pinjaman'];?></td>
                                                    <td><?php echo $rowpinjam['sumberdana'];?></td>
                                                   
                            					</tr>
                         			<?php $no++; } } else { ?>
                                                <tr><td colspan="9" class="text-center"><i>Tabel data tarik simpanan anggota kosong</i></td></tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                                <p class="text-right">Total <?php echo 'Rp. ' . number_format( $pnjm["jumlah"], 0 , '' , '.' ); ?></p>