<?php
  $id = (int)$_GET['id'];
  $id_proyecto        = (int)$_GET['id_proyecto'];
  $nombre             = $_GET['nombre'];
  $fecha_fin_anterior = $_GET['fecha_fin_anterior'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
   
?>
<?php
  $delete_id = rechaza_prorroga('prorroga_proyecto',(int)$_GET['id']);
  if($delete_id){
      $query = "UPDATE proyectos SET";
      $query .= " fecha_fin     ='{$fecha_fin_anterior}'";
      $query .= " WHERE id = {$id_proyecto}";
      $result   = $db->query($query);
      $session->msg("s","Prorroga rechazada");
      redirect('edit_proyectos_prorroga.php?id='.$id_proyecto.'&nombre='.$nombre);
  } else {
      $session->msg("d","Inactivación falló");
      redirect('edit_proyectos_prorroga.php?id='.$id_proyecto.'&nombre='.$nombre);
  }
?>
