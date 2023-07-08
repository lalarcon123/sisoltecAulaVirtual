<?php
  $id = (int)$_GET['id'];
  $id_producto = (int)$_GET['id_producto'];
  $descripcion = $_GET['descripcion'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
   
?>
<?php
  $delete_id = delete_by_id_estado('producto_imagenes','id='.(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Imagen eliminado");
      redirect('edit_producto_imagenes.php?id='.$id_producto.'&descripcion='.$descripcion);
  } else {
      $session->msg("d","Eliminación falló");
      redirect('edit_producto_imagenes.php?id='.$id_producto.'&descripcion='.$descripcion);
  }
?>
