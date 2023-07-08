<?php
  $id = (int)$_GET['id'];
  $id_solicitud_compra = (int)$_GET['id_solicitud_compra'];
  $id_proveedor = (int)$_GET['id_proveedor'];
  $descripcion  = $_GET['descripcion'];
  $cantidad_recibida  = $_GET['cantidad_recibida'];
  $precio  = $_GET['precio'];
  $id_producto  = $_GET['id_producto'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  // Checkin What level user has permission to view this page
   
?>
<?php
  $sql= "UPDATE productos p 
            SET p.cantidad = p.cantidad + '{$db->escape($cantidad_recibida)}'
          WHERE p.id = '{$db->escape($id_producto)}'";
  $result = $db->query($sql);
  $sql= "UPDATE producto_proveedores pp 
           SET pp.precio = '{$db->escape($precio)}'
           WHERE pp.id_proveedor = '{$db->escape($id_proveedor)}'
           AND pp.id_producto  = '{$db->escape($id_producto)}'";
  $result = $db->query($sql);
  $delete_id = Recep_by_id_estado('detalle_solicitud_compra','id='.(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Detalle activado");
      redirect('edit_detalle_solicitud_compra_recep.php?id='.$id_solicitud_compra.'&descripcion='.$descripcion.'&id_proveedor='.$id_proveedor);
  } else {
      $session->msg("d","Activación falló");
      redirect('edit_detalle_solicitud_compra_recep.php?id='.$id_solicitud_compra.'&descripcion='.$descripcion.'&id_proveedor='.$id_proveedor);
  }
?>
