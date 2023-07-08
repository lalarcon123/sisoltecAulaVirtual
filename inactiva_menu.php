<?php
  $id = (int)$_GET['id'];
  $id_det_menu = (int)$_GET['id_det_menu'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
   
?>
<?php
  $delete_id = delete_by_id_estado('usuario_menu',' det_menu_id = '.(int)$_GET['id_det_menu'].' and grupo_id = '.(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Opción eliminado");
      redirect('edit_opciones_menu_grupo.php?id='.$id);
  } else {
      $session->msg("d","Eliminación falló");
      redirect('edit_opciones_menu_grupo.php?id='.$id);
  }
?>
