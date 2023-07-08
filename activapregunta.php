<?php
  $id = (int)$_GET['id'];
  $id_curso = (int)$_GET['id_curso'];
  $id_evaluacion = (int)$_GET['id_evaluacion'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];

?>
<?php
  $delete_id = Activa_by_id_estado('evaluacion_preguntas',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Pregunta activada");
      $query_aud  = "insert auditoria (nombre_tabla, id_usuario, accion) values ('evaluacion_preguntas', ".$user.",'Eliminar')";
      $result_aud = $db->query($query_aud);
      if($result_aud && $db->affected_rows() === 1){
         redirect('edit_evaluacion_preguntas.php?id='.$id_evaluacion.'&id_curso='.$id_curso);
      }
  } else {
      $session->msg("d","Activación falló");
      redirect('edit_evaluacion_preguntas.php?id='.$id_evaluacion.'&id_curso='.$id_curso);
  }
?>
