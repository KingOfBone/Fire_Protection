<?php function menuSpv(){?>
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
                <a href="?password"><i class="fa fa-cogs"></i> Setting Akun</a>
            </div>
        </li>
    <li>
            <a href="?dashboard"><i class="fa fa-dashboard fa-2x"></i> Beranda</a>
            </li>
                     <li>
                        <a  href="?anggota"><i class="fa fa-users fa-2x"></i> Anggota</a>
                    </li>
                    <li>

                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sign-in fa-2x"></i> Setor Simpanan<span class="fa arrow"></span></a>
                        <ul >
                            <li><a href="#" class="back">Main Menu</a></li>
                            <li class="nav-label"><strong>Setor simpanan</strong></li>
                            <li>
                                <a href="?SetoranManual"> Manual</a>
                            </li>
                            <li>
                                <a  href="?SetoranBank"> Bank </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?tarSim"><i class="fa fa-sign-out fa-2x"></i>Tarik Simpanan</a>
                    </li>
                    <li>
                        <a  href="?pinjaman"><i class="fa fa-external-link-square fa-2x"></i> Pinjaman</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-spinner  fa-2x"></i><span class="fa arrow"></span> Angsuran </a>
                        <ul >
                            <li><a href="#" class="back">Main Menu</a></li>
                            <li class="nav-label"><strong>Angsuran</strong></li>
                            <li>
                                <a href="?AngsuranManual"> Manual</a>
                            </li>
                            <li>
                                <a href="?AngsuranBank"> Bank </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?pic"><i class="fa fa-money fa-2x"></i> PIC bank</a>
                    </li>

                    <li>
                        <a href="?berita"><i class="fa fa-list-alt fa-2x"></i> Berita</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-clipboard fa-2x"></i> Laporan<span class="fa arrow"></span></a>
                        <ul>
                            <li><a href="#" class="back">Main Menu</a></li>
                            <li class="nav-label"><strong>Laporan</strong></li>
                            <li>
                                <a   href="?lapAnggota">Anggota</a>
                            </li>
                            <li>
                                <a href="?lapSimpanan">Simpanan</a>
                            </li>
                            <li>
                                <a href="?lapPenarikan">Penarikan</a>
                            </li>
                            <li>
                                <a   href="?lapPinjaman">Pinjaman</a>
                            </li>
                            <li>
                                <a  href="?lapAngsuran">Angsuran</a>
                            </li>
                            <li>
                                <a   href="?lapTunggakan">Tunggakan</a>
                            </li>
                            <li>
                                <a href="?lapPeranggota">Peranggota</a>
                            </li>
                            <li>
                                <a href="?lapSHU">SHU</a>
                            </li>
                            <li>
                                <a  href="?lapRekapKeuangan">Rekap Keuangan</a>
                            </li>
                        </ul>
                    </li>

<?php } ?>
