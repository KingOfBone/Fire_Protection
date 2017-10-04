<?php function menuUs(){?>
<ul>
    <li><a class="text-right closeclick" href="#">close &times;</a></li>
        <li>
            <div class="imgprofile text-center">
            <?php
            $sqluserImg = mysql_query("SELECT * FROM tabel_users WHERE username ='$_SESSION[username]'") or die (mysql_error());
            $rowImg = mysql_fetch_array($sqluserImg);
            ?>

                <img src="<?php echo $rowImg["images"] == "" ? "images/foto/no-images.png" : "images/foto/".$rowImg["images"] ?>" class="img-circle img-responsive center-block"  />
                <br /><strong><?php echo $_SESSION["nama_lengkap"];?></strong>
                <a href="?profile"><i class="fa fa-cogs"></i> Setting profil</a>
            </div>
        </li>
     <li><a href="?dashboard"><i class="fa fa-dashboard fa-2x"></i> Beranda</a></li>
     <li><a href="?detail-simpanan"><i class="fa fa-inbox fa-2x"></i> Detail Simpanan</a></li>
     <li><a href="?detail-pinjaman"><i class="fa fa-external-link-square  fa-2x"></i> Detail Pinjaman</a></li>
     <li><a href="?TSimWjb"><i class="fa fa-sign-in fa-2x"></i> Tunggakan Simpanan</a></li>
     <li><a href="?lapPeranggotaUs"><i class="fa fa-paperclip fa-2x"></i> Peranggota</a></li>
     <li><a href="?neraca"><i class="fa fa-balance-scale fa-2x"></i> Neraca Laba Rugi</a></li>
     <li><a href="?download"><i class="fa fa-cloud-download fa-2x"></i> Download</a></li>
     <li><a href="?password"><i class="fa fa-lock fa-2x"></i> Ganti Password</a></li>
</ul>
<?php } ?>
