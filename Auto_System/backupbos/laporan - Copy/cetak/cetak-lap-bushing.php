<?php
    include "../../../config/koneksi.php";
    include "../../../config/utility.php";

    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Cache-control: private");
    header("Content-Type: application/vnd.ms-excel; name='excel'");
    header("Content-disposition: attachment; filename=laporanbushing.xls");

    $key     = $_GET['keycetak1'] ? $_GET['keycetak1'] : $_GET['keycetak1'];
    $key2     = $_GET['keycetak2'] ? $_GET['keycetak2'] : $_GET['keycetak2'];

    if (! $key=="" && !$key2==""){ $q = " bushing.tgloprs >= '$key' and date_sub(bushing.tgloprs, INTERVAL 1 day) <= '$key2'"; }

    $sql = mysql_query("SELECT
    bushing.kodebushing,
    bushing.serialid,
    bushing.tipeid,
    bushing.kodestatus,
    bushing.tegoprs,
    bushing.phasa,
    bushing.penempatan,
    bushing.tgloprs,
    bushing.kodemerk,
    bushing.thnbuat,
    bushing.kodetrafo,
    bushing.tipe,
    bushing.housing,
    bushing.jenis,
    bushing.pasangan,
    bushing.outerterm,
    bushing.tegmaks,
    bushing.arusmaks,
    bushing.bil,
    bushing.sil,
    bushing.pfw,
    bushing.tandelta,
    bushing.ctspace,
    bushing.jrkflgbtmend,
    bushing.dmtrflg,
    bushing.dmtrholetohole,
    bushing.jmlbaut,
    bushing.dmtrbaut,
    bushing.creepdist,
    bushing.kapc1,
    bushing.kapc2,
    bushing.kemiringan,
    bushing.sparkgap,
    bushing.taptest,
    bushing.berat,
    bushing.standart,
    bushing.techidentoold,
    bushing.objecttype,
    bushing.constype,
    bushing.techidento,
    bushing.eqnumber,
    bushing.equipmentnumber,
    bushing.idfunctloc,
    bushing.image,
    trafo.kodegi,
    gi.namagi,
    app.namaapp,
    merk.merk,
    buatan.buatan
    FROM
    bushing
    INNER JOIN trafo ON bushing.kodetrafo = trafo.kodetrafo
    INNER JOIN gi ON gi.kodegi = trafo.kodegi
    INNER JOIN app ON app.kodeapp = gi.kodeapp
    INNER JOIN merk ON bushing.kodemerk = merk.kodemerk
    INNER JOIN buatan ON buatan.kodebuatan = merk.kodebuatan
    WHERE $q ORDER BY bushing.kodebushing
    ") or die (mysql_error());
?>

<h2>Laporan Bushing</h2>
<br /><br />
<h3>History Bushing</h3>
<table border="1" >
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="17%">Serial ID</th>
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
            <td><?php echo $row['serialid'];?></td>
            <td><?php echo $row['namagi'];?></td>
            <td><?php echo $row['tgloprs'];?></td>
            <td><?php echo $row['buatan'];?></td>
            <td><?php echo $row['merk'];?></td>
            <td><?php echo $row['thnbuat'];?></td>
        </tr>
        <?php $no++; } } else { ?>
        <tr><td colspan="9" class="text-center"><i>Tabel data bushing kosong</i></td></tr>
        <?php } ?>
    </tbody>
</table>
