<?php

   require_once('includes/load.php');
   $user = $_SESSION['user_id'];
   $result  = find_by_user('users',$user);  
   foreach ($result as $row): 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Urocorp</title>
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
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">  
    <!-- Left navbar links -->
   
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php" class="nav-link"></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"></a>
      </li>
    </ul>
 

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <?php
              $cantidad = find_by_alertas_sin_leer('alerta','NOMBRE_SISTEMA');
              $cuantos = "";
              if (!empty($cantidad)){
                 $cuantos = $cantidad['cantidad'];
                 $result  = find_all_alertas('alerta');  
              }
          ?>
          <span class="badge badge-danger navbar-badge"><?php echo $cuantos;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <?php  foreach ($result as $fila): 
                $element = "<div class=\"media\">
                            <div class=\"media-body\">
                              <h3 class=\"dropdown-item-title\">
                              <h3 class=\"dropdown-item-title\">"
                              .$fila['descripcion']."<span class=\"float-right text-sm text-danger\">
                              <i class=\"fas fa-star\"></i></span></h3>
                                <p class=\"text-sm\">El stock llego al mínimo...</p>
                                <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> ".$fila['cantidad']."</p></div></div>";

                echo $element;
              endforeach; ?>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="ConsultaAlertas.php" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
        </div>
      </li>
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $row['nombres']; ?><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Configuracion</a>
                <!--<a class="dropdown-item" href="#">Activity Log</a>-->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Salir</a>
            </div>
        </li>
    </ul>

  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
<?php endforeach; ?>
  