<?php
    include "../../../config/koneksi.php";
    include "../../../config/utility.php";

    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Cache-control: private");
    header("Content-Type: application/vnd.ms-excel; name='excel'");
    header("Content-disposition: attachment; filename=laporanoltc.xls");

    $key     = $_GET['keycetak1'] ? $_GET['keycetak1'] : $_GET['keycetak1'];
    $key2     = $_GET['keycetak2'] ? $_GET['keycetak2'] : $_GET['keycetak2'];

    if (! $key=="" && !$key2==""){ $q = " oltc.tgloprs >= '$key' and date_sub(oltc.tgloprs, INTERVAL 1 day) <= '$key2'"; }

    $sql = mysql_query("SELECT
    oltc.kodeoltc,
    oltc.kodetrafo,
    oltc.serialid,
    oltc.typeid,
    oltc.kodepst,
    oltc.kodestatus,
    oltc.tegoprs,
    oltc.tgloprs,
    oltc.kodemerk,
    oltc.thnbuat,
    oltc.keterangan,
    oltc.tipe,
    oltc.techidentoold,
    oltc.objecttype,
    oltc.constype,
    oltc.techidento,
    oltc.eqnumber,
    oltc.equipmentnumber,
    oltc.idfunctloc,
    oltc.image,
    trafo.kodegi,
    gi.namagi,
    merk.merk,
    buatan.buatan,
    gi.kodeapp,
    app.namaapp
    FROM
    oltc
    INNER JOIN merk ON oltc.kodemerk = merk.kodemerk
    INNER JOIN trafo ON oltc.kodetrafo = trafo.kodetrafo
    INNER JOIN gi ON trafo.kodegi = gi.kodegi
    INNER JOIN buatan ON merk.kodebuatan = buatan.kodebuatan
    INNER JOIN app ON gi.kodeapp = app.kodeapp
    WHERE $q ORDER BY oltc.kodeoltc
    ") or die (mysql_error());
?>

<h2>Laporan OLTC</h2>
<br /><br />
<h3>History OLTC</h3>
<table border="1" >
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="10%">Nama APP</th>
            <th width="10%">Nama Gardu Induk</th>
            <th width="13%">Tanggal Operasi</th>
            <th width="14%">Buatan</th>
            <th width="14%">Merk</th>
            <th width="10%">Tahun Buat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(mysql_num_rows($sql) > 0){
                $no=1;
                while($row=mysql_fetch_array($sql))
            {
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row['namaapp'];?></td>
            <td><?php echo $row['namagi'];?></td>
            <td><?php echo $row['tgloprs'];?></td>
            <td><?php echo $row['buatan'];?></td>
            <td><?php echo $row['merk'];?></td>
            <td><?php echo $row['thnbuat'];?></td>
        </tr>
        <?php $no++; } } else { ?>
        <tr><td colspan="9" class="text-center"><i>Tabel data OLTC kosong</i></td></tr>
        <?php } ?>
    </tbody>
</table>
