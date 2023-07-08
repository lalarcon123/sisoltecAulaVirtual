<?php
  $id = (int)$_GET['id'];
  $id_curso = (int)$_GET['id_curso'];
  $id_capitulo = (int)$_GET['id_capitulo'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
?>
<?php
  $delete_id = delete_by_id_Material('contenido_capitulo',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Contenido eliminado");
      $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('contenido_capitulo', ".$user.",'Eliminar')";
      $result_aud = $db->query($query_aud);
      if($result_aud && $db->affected_rows() === 1){
         redirect('edit_capitulos_contenido.php?id='.$id_capitulo.'&id_curso='.$id_curso);
      }
  } else {
      $session->msg("d","Eliminación falló");
      redirect('edit_capitulos_contenido.php?id='.$id_capitulo.'&id_curso='.$id_curso);
  }
?>
