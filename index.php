
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

  // Define variables and initialize with empty values
  $username = $password = "";
  $username_err = $password_err = "";
?>

<?php include 'layouts/head-main.php'; ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

  <?php include 'layouts/head.php'; ?>

  <?php include 'layouts/head-style.php'; ?>

  <style> 

    .auth-full-page-content {
        min-height: 100vh;
    }

    body{
      height: 100%;
    }

    img{
      vertical-align: middle;
    }

    p{
      margin-bottom: 1rem;
    }

    .mt-4{
      margin-top: 1.5rem;
      padding-top: 0.5rem;
    }

    .logo-txt{
      color: black;
      font-size: 25px;
      font-weight: 700;
      margin-left: 5px;
    }

    .mb-0{
      font-size: 14px;
      font-weight: 700;
      margin-top: 10px;
      margin-block-start: 1.67em;
      margin-block-end: 1.67em;
      margin-inline-start: 0px;
      margin-inline-end: 0px;
    }

    .auth-bg{
      height: 100vh;
      background-image: url(assets/images/auth-bg.jpg);
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat
    }

    .mb-md-5{
      margin-bottom: 3rem;
    }

    .my-auto {
    margin-top: 82.5px;
    margin-bottom: 82.5px;
    }

    .check-container{
        width: 50px;
    }

    .form-check-label{
        margin-left: 20px;
    }


  </style>

</head>
<body>
<div class="pace pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="index.php" class="d-block auth-logo">
                                    <img src="assets/images/logo-sm.svg" alt="" height="30"> <span class="logo-txt">Blue Boddy</span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Welcome Blue Boddy !</h5>
                                    <p class="text-muted mt-2">Inicia sesión para continuar en Blue Boddy.</p>
                                </div>
                                <!--<form class="mt-4 pt-2" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">-->
                                <form class="mt-4 pt-2" action="auth.php" method="post">
                                    <div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="username">Usuario</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="Henry">
                                        <span class="text-danger"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="password">Contraseña</label>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="">
                                                    <a href="" class="text-muted">Olvidaste la contraseña?</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Enter password" name="password" value="123456" aria-label="Password" aria-describedby="password-addon">
                                            <span class="text-danger"><?php echo $password_err; ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col check-container">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">Recordarme
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Ingresar</button>
                                    </div>
                                </form>

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">No tienes cuenta registrada ? <a href="" class="text-primary fw-semibold"> Registrate aqui </a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-primary">
                    </div>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center">
                        <!--<div class="col-xl-7">-->
                            <!--<div class="p-0 p-sm-4 px-xl-0">-->
                                <!--
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">-->
                                    <!--
                                    <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    -->
                                    <!-- end carouselIndicators 
                                    <div class="carousel-inner">
                                        <!--
                                        <div class="carousel-item active">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“I feel confident
                                                    imposing change
                                                    on myself. It's a lot more progressing fun than looking back.
                                                    That's why
                                                    I ultricies enim
                                                    at malesuada nibh diam on tortor neaded to throw curve balls.”
                                                </h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-1.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Richard Drews
                                                            </h5>
                                                            <p class="mb-0 text-white-50">Web Designer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“Our task must be to
                                                    free ourselves by widening our circle of compassion to embrace
                                                    all living
                                                    creatures and
                                                    the whole of quis consectetur nunc sit amet semper justo. nature
                                                    and its beauty.”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-2.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Rosanna French
                                                            </h5>
                                                            <p class="mb-0 text-white-50">Web Developer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“I've learned that
                                                    people will forget what you said, people will forget what you
                                                    did,
                                                    but people will never forget
                                                    how donec in efficitur lectus, nec lobortis metus you made them
                                                    feel.”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <img src="assets/images/users/avatar-3.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        <div class="flex-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Ilse R. Eaton</h5>
                                                            <p class="mb-0 text-white-50">Manager
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>-->
                                    <!-- end carousel-inner 
                                </div>-->
                                <!-- end review carousel -->
                            <!--</div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/pages/pass-addon.init.js"></script>

<div id="volume-booster-visusalizer">
                    <div class="sound">
                        <div class="sound-icon"></div>
                        <div class="sound-wave sound-wave_one"></div>
                        <div class="sound-wave sound-wave_two"></div>
                        <div class="sound-wave sound-wave_three"></div>
                    </div>
                    <div class="segments-box">
                        <div data-range="1-20" class="segment"><span></span></div>
                        <div data-range="21-40" class="segment"><span></span></div>
                        <div data-range="41-60" class="segment"><span></span></div>
                        <div data-range="61-80" class="segment"><span></span></div>
                        <div data-range="81-100" class="segment"><span></span></div>
                    </div>
                </div>

</body>
<!-- /.login-box -->
<?php //include_once('layouts/footer.php'); ?>