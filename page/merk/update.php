<?php
if(isset($_POST["submit"])){
    $k     = mysql_real_escape_string(strip_tags($_POST["kodemerk"]));
    $m      = mysql_real_escape_string(strip_tags($_POST["merk"]));
    $b      = mysql_real_escape_string(strip_tags($_POST["buatan"]));

    mysql_query("UPDATE merk SET merk='$m', kodebuatan='$b' WHERE kodemerk='$k'");
    header("location:?merk&suksesedit");

}
$idA = (int)mysql_real_escape_string(trim($_GET["update-merk"]));
$sqlA = mysql_query("SELECT * FROM merk WHERE kodemerk = '$idA'") or die (mysql_error());
if(mysql_num_rows($sqlA)==0) header("location:?merk");
$rowA = mysql_fetch_array($sqlA);
?>
 <script type="text/javascript">
    function isNumberKeyTgl(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
    //     if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 47 || charCode > 57))
            return false;

         return true;
      }
      </script>
    <div id="wrapper">
        <!-- /. NAV SIDE  -->
       <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Ubah Merk</h2>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
       <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Ubah Merk
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <!-- id="validate-me-plz" -->
                        <form  name="form1" role="form" action="" method="post">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Kode Merk</label></div>
                                    <div class="col-md-5">
                                        <input  class="form-control" readonly name="kodemerk" value="<?php echo $rowA["kodemerk"] ?>" placeholder="masukkan kode merk" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom kode merk"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Merk</label></div>
                                    <div class="col-md-5">
                                        <input class="form-control" id="merk"  name="merk" type="text" value=<?php echo $rowA["merk"] ?> placeholder="masukkan data merk" data-rule-required="true" data-msg-required="Mohon masukkan data di kolom merk"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Buatan</label></div>
                                    <div class="col-md-5">
                                        <?php $sql = mysql_query("SELECT * FROM buatan") or die (mysql_error()); ?>
                                          <select name="buatan" id="buatan" class="form-control">
                                                <?php while ($data = mysql_fetch_array($sql)) { ?>
                                                  <option value="<?php echo $data["kodebuatan"]; ?>"><?php echo $data["buatan"]; ?></option>
                                                 <?php } ?>
                                           </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-8">
                                    <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                    <a href="?merk" class="btn btn-large btn-warning">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script type="text/javascript">
$('#validate-me-plz').validate({
      rules: {
        field: {
          required: true,
          date: true
        },
        alamat: {
                required: true
                }
        },
        messages: {
            alamat: {
            required: "Mohon masukkan data alamat"
                }
            }

    });
</script>
