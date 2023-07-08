
<?php 
  //include_once('layouts/header.php'); 

  ob_start();
  require_once('includes/load.php');
  $parametro_valor = find_by_parametro('parametros','NOMBRE_SISTEMA');
  $nombre_sistema = "";
  if (!empty($parametro_valor)){
     $nombre_sistema = $parametro_valor['valor'];
  }
  //if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        body {
              height: 100vh;
              display: flex;
              align-items: center;
              justify-content: center;
              background-image: url(img/silsoltec.png);
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
              color: #fff;
          }
    </style>
</head>
<body>
  <div class="row">
        <!--<div class="card">-->
    <!--<img typeof="foaf:Image" src="uploads/img/sisoltec.jpeg" />-->
    <div class="login-box">    
            <!--<div class="login-logo">-->
              <!--<a href=""><?php //echo $nombre_sistema; ?></a> -->
            <!--</div>-->
            <!-- /.login-logo -->
          <!--</div>-->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Inicia tu sesion</p>

            <?php echo display_msg($msg); ?>
            <form action="auth.php" method="post">
              <div class="input-group mb-3">
                <input name="username" type="name" class="form-control" placeholder="Usuario">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input  name="password" type="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                      Recordarme
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <p class="mb-1">
              <a href="olvide_contrasena.php">Olvidé mi contraseña</a>
            </p>
            <p class="mb-0">
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
   </div>
</div>
</body>
<!-- /.login-box -->
<?php //include_once('layouts/footer.php'); ?>