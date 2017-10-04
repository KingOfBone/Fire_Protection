<?php
include "config/imgset.php";
include "config/konfigurasi.php";

$sqlanggota = mysql_query("SELECT * FROM tabel_anggota WHERE nip ='$_SESSION[username]'") or die (mysql_error());
$rowanggota    = mysql_fetch_array($sqlanggota);

if(isset($_POST["submit"])){
    
    $nm         = mysql_real_escape_string(strip_tags($_POST["nm_agt"]));
    $jk         = mysql_real_escape_string(strip_tags($_POST["jenkel"]));
    $nt         = mysql_real_escape_string(strip_tags($_POST["no_tlp"]));
    $tml        = mysql_real_escape_string(strip_tags($_POST["tmp_lhr"]));
    $tg         = mysql_real_escape_string(strip_tags($_POST["tgl_lhr"]));
    $em         = mysql_real_escape_string(strip_tags($_POST["email"]));
    $nr         = mysql_real_escape_string(strip_tags($_POST["no_rek"]));
    $nb         = mysql_real_escape_string(strip_tags($_POST["nama_bank"]));
    $al         = mysql_real_escape_string(strip_tags($_POST["alamat"]));
    $nip        = mysql_real_escape_string(strip_tags($_POST["nip"]));
    
    
    $file_name = $_FILES["file"]["name"];
    $file_tmp_name = $_FILES["file"]["tmp_name"];
    
   if($file_name == "" || $file_name == null || empty($file_name)){
           
          
            
            mysql_query( "UPDATE tabel_anggota set  nama_anggota = '$nm', jen_kelamin = '$jk' ,no_telp = '$nt',
            alamat = '$al',tgl_lhr = '$tg',tmp_lhr = '$tml',no_rek = '$nr',nama_bank = '$nb', email = '$em'
            WHERE nip = '$nip' ");
            
            header("location:?profile&passB");
    }else{
            //menghapus gambar
            $sqlagt = mysql_query("SELECT * FROM tabel_users WHERE kode_user = '$kode'") or die (mysql_error());
            $rowH = mysql_fetch_array($sqlagt);
            
            unlink($Path.$rowH["images"]);
            $images     = uploadProductImage('file', 'images/foto/');
            $mainImage  = $images['image'];
            
            
            mysql_query("UPDATE tabel_anggota set  nama_anggota = '$nm', jen_kelamin = '$jk' ,no_telp = '$nt', email = '$email' ,
            alamat = '$nt',divisi = '$nt',tgl_lhr = '$nt',tmp_lhr = '$nt',no_rek = '$nt',nama_bank = '$nt', email='$email',
            foto='$mainImage'
            WHERE nip = '$nip' ");
            
            header("location:?profile&passB");
        }
    }
?>
<!-- Pick Day -->
<link rel="stylesheet" href="assets/pickday/css/pikaday.css" />
<script>
 function isNumberKeyTgl(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
     //    if (charCode > 31 && (charCode < 47 || charCode > 57))
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
                        <h2 style="margin: 0;" class="text-center">Form profile anggota</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
       <!-- content -->
    <div class="row">
    <div class="col-md-2"></div>
                    <div class="col-xs-8">
                        <?php if(isset($_GET["pasX"])){?>
                        <div class="alert alert-danger">Password lama salah...!!!
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                        </div>
                        <?php }else if(isset($_GET["passB"])){ ?>
                        <div class="alert alert-success">Profile anggota telah di perbaharui...!!!
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="row">
                    <form role="form"  action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <img src="<?php echo $rowanggota["foto"] == "" ? "images/foto/no-images.png" : "images/foto/".$rowanggota["foto"] ?>" class=" img-responsive center-block"  />
                                        <input class="text-center center-block" name="file" type="file" />
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label>No Anggota</label></div>
                                <div class="col-md-8">
                                    <input class="form-control" value="<?php echo $rowanggota["no_anggota"]; ?>" type="text" readonly=""/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label>Nip</label></div>
                                <div class="col-md-8">
                                    <input type="hidden" name="nip" value="<?php echo $rowanggota["nip"];?>" />
                                    <input class="form-control" value="<?php echo $rowanggota["nip"]; ?>" type="text" readonly=""/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label>Nama Anggota</label></div>
                                <div class="col-md-8">
                                    <input class="form-control" name="nm_agt" value="<?php echo $rowanggota["nama_anggota"]; ?>" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Jenis Kelamin</label></div>
                                    <div class="col-md-8">
                                        <select class="form-control" name="jenkel">
                                            <option value="">- Pilih -</option>
                                            <option value="pria" <?php if($rowanggota["jen_kelamin"]=="pria"){?> selected="selected" <?php } ?>> Pria</option>
                                            <option value="wanita" <?php if($rowanggota["jen_kelamin"]=="wanita"){?> selected="selected" <?php } ?> > Wanita</option>
                                        </select> 
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label>No Telp</label></div>
                                <div class="col-md-8">
                                    <input class="form-control" name="no_tlp" onKeyPress="return isNumberKey(event)"  value="<?php echo $rowanggota["no_telp"]; ?>" type="text"  />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label>Tempat lahir</label></div>
                                <div class="col-md-8">
                                    <input class="form-control" name="tmp_lhr" value="<?php echo $rowanggota["tmp_lhr"]; ?>" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label>Tanggal Lahir</label></div>
                                <div class="col-md-8">
                                    <input class="form-control" name="tgl_lhr" id="datepck" onKeyPress="return isNumberKeyTgl(event)" value="<?php if($rowanggota["tgl_lhr"]=="0000-00-00"){} else { echo $rowanggota["tgl_lhr"] ; } ?>" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label>Email</label></div>
                                    <div class="col-md-8">
                                        <input class="form-control" name="email"  value="<?php echo $rowanggota["email"]; ?>" type="text"/>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label>No Rekening</label></div>
                                <div class="col-md-8">
                                    <input class="form-control" name="no_rek" onKeyPress="return isNumberKey(event)"  value="<?php echo $rowanggota["no_rek"]; ?>" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label>Nama Bank</label></div>
                                <div class="col-md-8">
                                    <input class="form-control" name="nama_bank" value="<?php echo $rowanggota["nama_bank"]; ?>" type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3"><label>Alamat</label></div>
                                <div class="col-md-8">
                                    <textarea name="alamat" class="form-control"><?php echo $rowanggota["alamat"]?></textarea>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <button type="submit" name="submit" class="btn btn-large btn-success">Simpan</button>
                                        <button onclick="goBack()" class="btn btn-large btn-warning">Kembali</button>
                                    </div>
                                </div>
                    </div>
                    
                </form>
            </div>

        </div>
       </div>
               
    </div>
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>
<script src="assets/pickday/moment.js"></script>
<script src="assets/pickday/pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepck'),
        firstDay: 1,
        minDate: new Date(1960, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1960, 2020],
        format: 'DD/MM/YYYY'
    });
    jQuery.validator.methods["date"] = function (value, element) { return true; } 
</script>
<script type="text/javascript">
$('#validate').validate({
      rules: {
        field: {
          required: true,
          date: true
        }
      }
    });
function goBack() {
    window.history.back();
}
</script> 
