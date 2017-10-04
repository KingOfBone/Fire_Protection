<?php
include "../../../config/koneksi.php";
include "../../../config/utility.php";

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Cache-control: private");
header("Content-Type: application/vnd.ms-excel; name='excel'");
header("Content-disposition: attachment; filename=laporanperanggota.xls");

    $key     = ($_POST['keycetak']) ? $_POST['keycetak'] : $_GET['keycetak'];
    if (! $key==0){ $q = " CONCAT(nama_anggota,' (', nip,')') LIKE '%$key%'"; }
    
    $setor = mysql_query("SELECT tabel_simpanan.no_anggota , tabel_anggota.nama_anggota, tabel_simpanan.tgl_simpanan, 
    tabel_simpanan.jumlah , tabel_simpanan.jenis_simpanan FROM tabel_anggota JOIN tabel_simpanan 
    ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota WHERE $q AND tabel_simpanan.jenis='setor'
    ORDER BY tabel_simpanan.kode_simpanan") or die (mysql_error());
    
    $tarik = mysql_query("SELECT tabel_simpanan.no_anggota , tabel_anggota.nama_anggota, tabel_simpanan.tgl_simpanan, 
    tabel_simpanan.jumlah , tabel_simpanan.jenis_simpanan FROM tabel_anggota JOIN tabel_simpanan 
    ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota WHERE  $q AND tabel_simpanan.jenis='tarik' 
    ORDER BY tabel_simpanan.kode_simpanan") or die (mysql_error());
    
    $pinjaman = mysql_query("SELECT tabel_pinjaman.* , tabel_anggota.no_anggota, tabel_anggota.nama_anggota
    FROM tabel_pinjaman JOIN tabel_anggota ON tabel_pinjaman.no_anggota = tabel_anggota.no_anggota WHERE $q 
    ORDER BY tabel_pinjaman.kode_pinjaman DESC") or die (mysql_error());
    
    $angsuran = mysql_query("SELECT tabel_angsuran.* , tabel_anggota.nama_anggota FROM tabel_angsuran 
    JOIN tabel_anggota ON tabel_angsuran.no_anggota = tabel_anggota.no_anggota
    WHERE $q and tabel_angsuran.status_angsuran = 'Lunas' ORDER BY tabel_angsuran.kode_angsuran DESC") or die (mysql_error());
    
    $tunggakan = mysql_query("SELECT tabel_angsuran.* , tabel_anggota.nama_anggota FROM tabel_angsuran 
    JOIN tabel_anggota ON tabel_angsuran.no_anggota = tabel_anggota.no_anggota
    WHERE $q and tabel_angsuran.status_angsuran = 'Belum Lunas' ORDER BY tabel_angsuran.kode_angsuran DESC") or die (mysql_error());
    
    
    /* jumlah total */
    
    $jmlsetor = mysql_query("SELECT SUM(tabel_simpanan.jumlah) as jumlah ,  tabel_simpanan.no_anggota , tabel_anggota.nama_anggota, 
    tabel_simpanan.tgl_simpanan, tabel_simpanan.jenis_simpanan FROM tabel_anggota JOIN tabel_simpanan 
    ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota WHERE  $q AND tabel_simpanan.jenis='setor'") or die (mysql_error());
    $jml1 = mysql_fetch_array($jmlsetor);
    
    $jmltarik = mysql_query("SELECT SUM(tabel_simpanan.jumlah) as jumlah , tabel_simpanan.no_anggota , tabel_anggota.nama_anggota, 
    tabel_simpanan.tgl_simpanan, tabel_simpanan.jenis_simpanan FROM tabel_anggota JOIN tabel_simpanan 
    ON tabel_simpanan.no_anggota = tabel_anggota.no_anggota WHERE $q AND tabel_simpanan.jenis='tarik'
    ORDER BY tabel_simpanan.kode_simpanan DESC") or die (mysql_error());
    $jml2 = mysql_fetch_array($jmltarik);
    
    $jmlpinjaman = mysql_query("SELECT SUM(tabel_pinjaman.jumlah_pinjaman) as jumlah , tabel_pinjaman.* , tabel_anggota.no_anggota, tabel_anggota.nama_anggota
    FROM tabel_pinjaman JOIN tabel_anggota ON tabel_pinjaman.no_anggota = tabel_anggota.no_anggota 
    WHERE $q ORDER BY tabel_pinjaman.kode_pinjaman DESC") or die (mysql_error());
    $jml3 = mysql_fetch_array($jmlpinjaman);
    
    $jmlangsuran = mysql_query("SELECT SUM(tabel_angsuran.angsuran_bayar) as jumlah , tabel_angsuran.kode_angsuran ,  tabel_anggota.nama_anggota 
    FROM tabel_angsuran JOIN tabel_anggota ON tabel_angsuran.no_anggota = tabel_anggota.no_anggota
    WHERE $q and tabel_angsuran.status_angsuran = 'Lunas' ORDER BY tabel_angsuran.kode_angsuran DESC") or die (mysql_error());
    $jml4 = mysql_fetch_array($jmlangsuran);
    
    $jmltunggakan = mysql_query("SELECT SUM(tabel_angsuran.angsuran_bayar) as jumlah , tabel_angsuran.kode_angsuran ,  tabel_anggota.nama_anggota 
    FROM tabel_angsuran JOIN tabel_anggota ON tabel_angsuran.no_anggota = tabel_anggota.no_anggota
    WHERE $q and tabel_angsuran.status_angsuran = 'Belum Lunas' ORDER BY tabel_angsuran.kode_angsuran DESC") or die (mysql_error());
    $jml5 = mysql_fetch_array($jmltunggakan);
?>
<h2>Laporan Peranggota</h2>
<br /><br />
<h3>History setor simpanan anggota</h3>
<table border="1" >
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="17%">No Anggota</th>
            <th width="17%">Nama</th>
            <th width="15%">Tgl Simpanan</th>
            <th width="20%">Jumlah</th>
            <th width="20%">Jenis simpanan</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; while($rowsetor=mysql_fetch_array($setor)) { ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $rowsetor['no_anggota'];?></td>
        <td><?php echo $rowsetor['nama_anggota'];?></td>
        <td><?php echo tglindonesia($rowsetor['tgl_simpanan']);?></td>
        <td><?php echo 'Rp. ' . number_format( $rowsetor['jumlah'], 0 , '' , '.' );?></td>
        <td><?php echo $rowsetor['jenis_simpanan'];?></td>
    </tr>
    <?php $no++; } ?>
    </tbody>
</table>
<p class="text-right">Total <?php echo 'Rp. ' . number_format( $jml1["jumlah"], 0 , '' , '.' ); ?></p>
<br /><br />
<h3>History Tarik simpanan anggota </h3>
<table border="1" >
    <thead>
    <tr>
        <th width="2%">No</th>
        <th width="17%">No Anggota</th>
        <th width="17%">Nama</th>
        <th width="15%">Tgl Simpanan</th>
        <th width="20%">Jumlah</th>
        <th width="20%">Jenis simpanan</th>
    </tr>
    </thead>
    <tbody>
    <?php $no=1; while($rowtarik=mysql_fetch_array($tarik)) { ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $rowtarik['no_anggota'];?></td>
            <td><?php echo $rowtarik['nama_anggota'];?></td>
        <td><?php echo tglindonesia($rowtarik['tgl_simpanan']);?></td>
        <td><?php echo 'Rp. ' . number_format( $rowtarik['jumlah'], 0 , '' , '.' );?></td>
        <td><?php echo $rowtarik['jenis_simpanan'];?></td>
    </tr>
    <?php $no++; } 	?>
    </tbody>
</table>
<p class="text-right">Total <?php echo 'Rp. ' . number_format( $jml2["jumlah"], 0 , '' , '.' ); ?></p>
<br /><br />
<h3>History Pinjaman anggota</h3>
<table border="1" >
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                  						    <th width="13%">No Anggota</th>
                                            <th width="20%">Nama</th>
                      						<th width="16%">Tgl Pinjaman</th>
                                            <th width="16%">Jumlah Pinjaman</th>
                      						<th width="12%">Jangka Waktu</th>
                                            <th width="8%">Bunga</th>
                                            <th width="18%">Jumlah Angsuran</th>
                       					</tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no=1;
                                    while($rowpinjam=mysql_fetch_array($pinjaman))
                    				{
                    				    ?>
                            					<tr>
                                                    <td><?php echo $no; ?></td>
                            						<td><?php echo $rowpinjam['no_anggota'];?></td>
                            						<td><?php echo $rowpinjam['nama_anggota'];?></td>
                                                    <td><?php echo tglindonesia($rowpinjam['tgl_pinjaman']);?></td>
                                                    <td><?php echo 'Rp. ' . number_format( $rowpinjam['jumlah_pinjaman'], 0 , '' , '.' );?></td>
                                                    <td><?php echo $rowpinjam['jangka_waktu'];?></td>
                                                    <td><?php echo $rowpinjam['bunga'];?> %</td>
                                                    <td><?php echo 'Rp. ' . number_format( $rowpinjam['jumlah_angsuran'], 0 , '' , '.' );?></td>
                                                    
                            					</tr>
                            				<?php
                            				$no++; }
                            				?>
                                    </tbody>
                                </table>
<p class="text-right">Total <?php echo 'Rp. ' . number_format( $jml3["jumlah"], 0 , '' , '.' ); ?></p>
<br /><br />
<h3>Table data angsuran</h3>
<table border="1" >
                                            <thead>
                                                <tr>
                                                    <th width="2%">No</th>
                          					<!--	    <th width="17%">Kode Pinjaman</th>  -->
                              						<th width="15%">Tangal angsuran</th>
                              						<th width="20%">Angsuran ke</th>
                                                   <th width="20%">Jumlah Angsuran</th>
                               					</tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                    				$no=1;
                                                    while($rowAngsur=mysql_fetch_array($angsuran))
                                    				{
                                    				?>
                                    					<tr>
                                                            <td><?php echo $no; ?></td>
                                    				<!--		<td><?php echo $rowAngsur['no_pinjaman'];?></td>  -->
                                                            <td><?php echo tglindonesia($rowAngsur['tgl_angsuran']);?></td>
                                                            <td><?php echo $rowAngsur['angsuran_ke'];?></td>
                                                          <td><?php echo 'Rp. ' . number_format( $rowAngsur['angsuran_bayar'], 0 , '' , '.' );?></td>
                                                        </tr>
                                    				<?php
                                    				$no++; }
                                    				?>
                                            </tbody>
                                        </table>
<p class="text-right">Total <?php echo 'Rp. ' . number_format( $jml4["jumlah"], 0 , '' , '.' ); ?></p>
<br /><br />
<h3>Table data Tunggakan (Angsuran yang belum lunas)</h3>
<table border="1" >
                                            <thead>
                                                <tr>
                                                    <th width="2%">No</th>
                          					<!--	    <th width="17%">Kode Pinjaman</th>  -->
                              						<th width="15%">Tangal angsuran</th>
                              						<th width="20%">Angsuran ke</th>
                                                   <th width="20%">Jumlah Angsuran</th>
                               					</tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                    				$no=1;
                                                    while($rowTunggakan=mysql_fetch_array($tunggakan))
                                    				{
                                    				?>
                                    					<tr>
                                                            <td><?php echo $no; ?></td>
                                    				<!--		<td><?php echo $rowTunggakan['no_pinjaman'];?></td> -->
                                                            <td><?php echo tglindonesia($rowTunggakan['tgl_angsuran']);?></td>
                                                            <td><?php echo $rowTunggakan['angsuran_ke'];?></td>
                                                          <td><?php echo 'Rp. ' . number_format( $rowTunggakan['angsuran_bayar'], 0 , '' , '.' );?></td>
                                                        </tr>
                                    				<?php
                                    				$no++; }
                                    				?>
                                            </tbody>
                                        </table>
<p class="text-right">Total <?php echo 'Rp. ' . number_format( $jml5["jumlah"], 0 , '' , '.' ); ?></p>