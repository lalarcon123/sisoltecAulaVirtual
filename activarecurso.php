<?php
  $id = (int)$_GET['id'];
  $id_proyecto = (int)$_GET['id_proyecto'];
  $descripcion = $_GET['descripcion'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
   
?>
<?php
  $delete_id = Activa_by_id_estado('recursos_proyectos',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Recurso activado");
      redirect('edit_proyectos_recursos.php?id='.$id_proyecto.'&descripcion='.$descripcion);
  } else {
      $session->msg("d","Activación falló");
      redirect('edit_proyectos_recursos.php?id='.$id_proyecto.'&descripcion='.$descripcion);
  }
?>
