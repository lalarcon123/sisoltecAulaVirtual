<?php
  $id = (int)$_GET['id'];
  $id_curso = (int)$_GET['id_curso'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
?>
<?php
  $delete_id = delete_by_id_Material('contenido_curso',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Evaluación eliminado");
      $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('contenido_curso', ".$user.",'Eliminar')";
      $result_aud = $db->query($query_aud);
      if($result_aud && $db->affected_rows() === 1){
         redirect('edit_curso_evaluacion.php?id='.$id_curso);
      }
  } else {
      $session->msg("d","Eliminación falló");
      redirect('edit_curso_evaluacion.php?id='.$id_curso);
  }
?>
