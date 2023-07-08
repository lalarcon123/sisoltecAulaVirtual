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

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="uploads/img/sisoltec.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $nombre_sistema; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) 
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Usuario</a>
        </div>
      </div>
      -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

 <?php  foreach ($result as $row): 

    $element = "<li class=\"nav-item has-treeview menu-open\">
            <a href=\"".$row['pagina']."\" class=\"nav-link active\">
              <i class=\"nav-icon fas fa-caret-down\"></i>
              <p>".$row['descripcion']."
                <i class=\"right fas fa-angle-left\"></i>
              </p>
            </a>";

    echo $element;
           $resultado  = find_all_submenu('det_menu',$row['id_menu'],$userc['user_level']);         
           foreach ($resultado as $row_detalle):
                $element_submenu = "<ul class=\"nav nav-treeview\">
                          <li class=\"nav-item\">
                            <a href=\"".$row_detalle['pagina']."\" class=\"nav-link active\">
                              <i class=\"fas fa-arrow-right\"></i>
                              <p>".$row_detalle['descripcion']."</p>
                            </a>
                          </li>
                        </ul>";
                echo $element_submenu;
           endforeach;
    $element_fin = "</li>";

    echo $element_fin;

  endforeach; ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  