<?php 
    
    require_once('includes/load.php');
    $userc = current_user();
    $user = $_SESSION['user_id'];
    $result  = find_all_menu('menu',$user);  
    $parametro_valor = find_by_parametro('parametros','NOMBRE_SISTEMA');
    $nombre_sistema = "";
    if (!empty($parametro_valor)){
       $nombre_sistema = $parametro_valor['valor'];
    }

?>

<head>
  <meta charset="UTF-8">
  <title> Drop Down Sidebar Menu | CodingLab </title>
  <link rel="stylesheet" href="../sisoltecaulavirtual/css/style.css">
  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

  <!-- Brand Logo -->

  <!-- Sidebar -->
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Blue Boddy</span>
    </div>
    <ul class="nav-links">
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxs-briefcase-alt-2'></i>
            <span class="link_name">Administración</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Administración</a></li>
          <li><a href="#">Usuarios</a></li>
          <li><a href="#">Perfiles</a></li>
          <li><a href="#">Modulos</a></li>
          <li><a href="#">Opciones</a></li>
          <li><a href="#">Opciones por Perfil</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-cog'></i>
            <span class="link_name">Mantenimiento</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Mantenimiento</a></li>
          <li><a href="#">Categoría</a></li>
          <li><a href="#">Subcategoría</a></li>
          <li><a href="#">Tipo de Proyecto</a></li>
          <li><a href="#">Clientes</a></li>
          <li><a href="#">Tipo de Tarea</a></li>
          <li><a href="#">Productos</a></li>
          <li><a href="#">Proveedores</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-network-chart'></i>
            <span class="link_name">Procesos</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Procesos</a></li>
          <li><a href="#">Proyectos</a></li>
          <li><a href="#">Solicitud de compra</a></li>
          <li><a href="#">Recepción Compra</a></li>
          <li><a href="#">Prórroga</a></li>
        </ul>
      </li>
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="image/profile.jpg" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name">Prem Shahi</div>
            <div class="job">Web Desginer</div>
          </div>
          <i class='bx bx-log-out' ></i>
        </div>
      </li>
</ul>
  </div>


  <!-- /.sidebar -->


  