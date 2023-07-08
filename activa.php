<?php
  $id = (int)$_GET['id'];
  $id_examen = (int)$_GET['id_examen'];
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   
?>
<?php
  $delete_id = Activa_by_id_estado('listado_examenes','id = '.(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Opción activado");
      redirect('edit_listados_materiales.php?id='.$id_examen);
  } else {
      $session->msg("d","Activación falló");
      redirect('edit_listados_materiales.php?id='.$id_examen);
  }
?>
