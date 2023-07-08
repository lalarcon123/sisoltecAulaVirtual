<?php
  $id = (int)$_GET['id'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
   
?>
<?php

  $query  = "UPDATE solicitudcompra SET";
  $query .= " monto = (SELECT SUM(PRECIO*CANTIDAD) FROM detalle_solicitud_compra WHERE id_solicitud_compra = {$id})";
  $query .= " WHERE id        = {$id}";
  $result   = $db->query($query);
  $delete_id = Finaliza_by_tarea('solicitudcompra',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Solicitud finalizada");
      redirect('detallessolicitudescompra.php');
  } else {
      $session->msg("d","Activación falló");
      redirect('detallessolicitudescompra.php');
  }
?>
