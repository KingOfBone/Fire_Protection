<?php
	ob_start();
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MONPAR</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />

    <style>
    .error{
        padding: 10px 0 0 10px;
    }
    </style>
</head>
<body class="bgbody">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 login-panel ">
                <?php if(isset($_GET["failed"])){?>
                         <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            Harap Koreksi Username/Password Anda
                         </div>
                        <?php } else if(isset($_GET["noakses"])){?>
                        <div class="alert alert-warning alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            mohon maaf anda belum login
                         </div>
                        <?php } ?>
                <div class="panel panel-default btn-block">
                    <div class="panel-heading ">
                        <h3 class="panel-title text-center">MONPAR</h3>
                    </div>
                    <div class="panel-body pb">
                        <form role="form" action="login_pros.php" method="post" id="validate-me-plz">
                            <fieldset>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" id="focusedInput" placeholder="username" name="username" type="text" autofocus data-rule-required="true" data-msg-required="Mohon masukkan username"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input class="form-control" placeholder="Password" name="password" type="password" data-rule-required="true" data-msg-required="Mohon masukkan password" />
                                    </div>
                                </div>
                                <input value="login" name="submit_login" type="submit" class="btn btn-lg btn-success btn-block" />
                                <a class="pull-right" href="#" data-toggle="modal" data-target="#myModal">Lupa password ?</a>


                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/js/sb-admin.js"></script>
    <!-- validate -->
<script type="text/javascript" src="assets/validasi/jquery.validate.min.js"></script>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 0;">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lupa Password</h4>
      </div>
      <div class="modal-body">
      <p>Silahkan masukkan email anda untuk mendapatkan mereset password anda</p>
        <form role="form" action="sukses.php" method="post" >
            <fieldset>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon" style="border-radius:0"><i class="fa fa-envelope-o"></i></span>
                        <input class="form-control" placeholder="email" name="email" type="email" required />
                    </div>
                </div>

                <input value="Kirim" name="submit_login" type="submit" class="btn btn-lg btn-success pull-right" />
            </fieldset>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>
</body>
</html>
<?php
ob_end_flush();
?>
