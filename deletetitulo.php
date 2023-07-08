<?php
  $id = (int)$_GET['id'];
  $usuario = (int)$_GET['usuario'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
?>
<?php
  $delete_id = delete_by_id_td('titulos_docente',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Título eliminado");
      $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('titulos_docente', ".$user.",'Elimina Titulo Docente')";
      $result_aud = $db->query($query_aud);
      if($result_aud && $db->affected_rows() === 1){
          redirect('edit_docente_titulo.php?id='.$usuario);
      }
  } else {
      $session->msg("d","Eliminación falló");
      redirect('edit_docente_titulo.php?id='.$usuario);
  }
?>
