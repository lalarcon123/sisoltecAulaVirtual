<?php
  $id = (int)$_GET['id'];
  $id_solicitud_compra = (int)$_GET['id_solicitud_compra'];
  $id_proveedor = (int)$_GET['id_proveedor'];
  $descripcion  = $_GET['descripcion'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
   
?>
<?php
  $delete_id = Activa_by_id_estado('detalle_solicitud_compra','id='.(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Detalle activado");
      redirect('edit_detalle_solicitud_compra.php?id='.$id_solicitud_compra.'&descripcion='.$descripcion.'&id_proveedor='.$id_proveedor);
  } else {
      $session->msg("d","Activación falló");
      redirect('edit_detalle_solicitud_compra.php?id='.$id_solicitud_compra.'&descripcion='.$descripcion.'&id_proveedor='.$id_proveedor);
  }
?>
