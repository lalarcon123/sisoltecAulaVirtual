<?php
  $id = (int)$_GET['id'];
  $id_proyecto = (int)$_GET['id_proyecto'];
  $descripcion = $_GET['descripcion'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
   
?>
<?php
  $delete_id = delete_by_id_estado('recursos_proyectos',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Recurso inactivado");
      redirect('edit_proyectos_recursos.php?id='.$id_proyecto.'&descripcion='.$descripcion);
  } else {
      $session->msg("d","Inactivación falló");
      redirect('edit_proyectos_recursos.php?id='.$id_proyecto.'&descripcion='.$descripcion);
  }
?>
