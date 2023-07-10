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

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.112.5">
  <title>Sidebars · Bootstrap v5.3</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">






  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
  <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
  <meta name="theme-color" content="#712cf9">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }
    .bd-mode-toggle {
      z-index: 1500;
    }
  </style>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="../sisoltecaulavirtual/css/sidebars.css" rel="stylesheet">
</head>
<body>

</body>
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="uploads/img/sisoltec.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $nombre_sistema; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="flex-shrink-0 p-3" style="width: 280px;">
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
          Administración
        </button>
        <div class="collapse" id="home-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Usuarios</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Perfiles</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Módulos</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Opciones</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Opciones por perfil</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Mantenimiento
        </button>
        <div class="collapse" id="dashboard-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Categoría</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Subcategoría</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Tipo de Proyecto</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Clientes</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Tipo Tarea</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Productos</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Proveedores</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Procesos
        </button>
        <div class="collapse" id="orders-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Proyectos</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Solicitud de compra</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Recepción de compra</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Prorroga</a></li>
          </ul>
        </div>
      </li>
      </ul>
    </ul>
  </div>
    <!-- /.sidebar -->
  </aside>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="../sisoltecaulavirtual/js/sidebars.js"></script>
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