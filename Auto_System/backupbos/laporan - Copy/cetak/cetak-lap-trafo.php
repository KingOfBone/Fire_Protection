<?php
    include "../../../config/koneksi.php";
    include "../../../config/utility.php";

    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Cache-control: private");
    header("Content-Type: application/vnd.ms-excel; name='excel'");
    header("Content-disposition: attachment; filename=laporantrafo.xls");

    $key     = $_GET['keycetak1'] ? $_GET['keycetak1'] : $_GET['keycetak1'];
    $key2     = $_GET['keycetak2'] ? $_GET['keycetak2'] : $_GET['keycetak2'];

    if (! $key=="" && !$key2==""){ $q = " trafo.tgloprs >= '$key' and date_sub(trafo.tgloprs, INTERVAL 1 day) <= '$key2'"; }

    $sql=mysql_query("SELECT
    trafo.kodetrafo,
    trafo.kodegi,
    trafo.namabay,
    trafo.serialid,
    trafo.typeid,
    trafo.idbay,
    trafo.kodepst,
    trafo.kodestatus,
    trafo.tegoprs,
    trafo.tgloprs,
    trafo.impdns,
    trafo.kodemerk,
    trafo.thnbuat,
    trafo.jenis,
    trafo.penempatan,
    trafo.keterangan,
    trafo.flag,
    trafo.jeniskonsv,
    trafo.tglhistory,
    trafo.tmsaktif,
    trafo.tegoperasi,
    trafo.idfireprotection,
    trafo.idproteksimekanik,
    trafo.idonlinemonitoring,
    trafo.constype,
    trafo.description,
    trafo.asset,
    trafo.techidentno,
    trafo.eqnumber,
    trafo.daya,
    trafo.vectorx,
    trafo.equipmentnumber,
    trafo.idfunctloc,
    trafo.tipe,
    trafo.tegprimrated,
    trafo.tegsecrated,
    trafo.tegprimmax,
    trafo.tegsecmax,
    trafo.tegtermax,
    trafo.arusprim,
    trafo.arussec,
    trafo.aruster,
    trafo.vector,
    trafo.bil,
    trafo.sil,
    trafo.pfwv,
    trafo.suhu,
    trafo.suhunaikw,
    trafo.suhunaiko,
    trafo.cooling,
    trafo.jmlkips,
    trafo.jnsisokertas,
    trafo.klsiso,
    trafo.panjang,
    trafo.lebar,
    trafo.tinggi,
    trafo.brtminyak,
    trafo.brtintibltn,
    trafo.brttot,
    trafo.jnsminyak,
    trafo.jrkroda,
    trafo.jrkas,
    trafo.standard,
    trafo.pasangan,
    trafo.bilsec,
    trafo.bilter,
    trafo.pfwsec,
    trafo.pfwter,
    trafo.brtmainfitting,
    trafo.dayater,
    trafo.deltategtap,
    trafo.jmlcoolingpump,
    trafo.jmlgroupkipas,
    trafo.jmltap,
    trafo.tegtapbawah,
    trafo.tegtapatas,
    trafo.tegtapnormal,
    trafo.tipeminyak,
    trafo.waktusc,
    trafo.image,
    gi.namagi,
    app.namaapp,
    merk.merk,
    buatan.buatan
    FROM
    trafo
    INNER JOIN gi ON gi.kodegi = trafo.kodegi
    INNER JOIN app ON app.kodeapp = gi.kodeapp
    INNER JOIN merk ON merk.kodemerk = trafo.kodemerk
    INNER JOIN buatan ON buatan.kodebuatan = merk.kodebuatan
    WHERE $q ORDER BY trafo.kodetrafo
    ") or die (mysql_error());
?>

<h2>Laporan Trafo</h2>
<br /><br />
<h3>History Trafo</h3>
<table border="1" >
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="10%">Nama Gardu Induk</th>
            <th width="17%">Nama Bay</th>
            <th width="13%">Tanggal Operasi</th>
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
            <td><?php echo $row['namagi'];?></td>
            <td><?php echo $row['namabay'];?></td>
            <td><?php echo $row['tgloprs'];?></td>
            <td><?php echo $row['merk'];?></td>
            <td><?php echo $row['thnbuat'];?></td>
        </tr>
        <?php $no++; } } else { ?>
        <tr><td colspan="9" class="text-center"><i>Tabel data trafo kosong</i></td></tr>
        <?php } ?>
    </tbody>
</table>
