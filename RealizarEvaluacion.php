<?php
  $id = (int)$_GET['id'];
  $id_curso = (int)$_GET['id_curso'];
  $id_pregunta = (int)$_GET['id_pregunta'];
  $id_respuesta = (int)$_GET['id_respuesta'];
  require_once('includes/load.php');
  $user = $_SESSION['user_id'];
  $realizo_evaluacion = valida_evaluacion($user,$id_curso,$id);
  if ($realizo_evaluacion ===0){ 
      if (!empty($id_respuesta) && $id_pregunta!=0){
         $graba = graba_respuesta($user, $id, $id_pregunta, $id_respuesta);
         $sql = "UPDATE evaluacion_estudiante set respondida =  'SI' where id_user = '{$user}' and id_curso_oferta = '{$id_curso}' and id_evaluacion = '{$id}' and id_pregunta = '{$id_pregunta}'";
         $result = $db->query($sql);
      }
      $Preguntas  = find_all_evaluacion_estudiante('evaluacion_estudiante',$id,$user);
      $existen_preguntas = 0;
      foreach ($Preguntas as $contenido_curso):
        $existen_preguntas = 1;
        $id_pregunta = $contenido_curso['id_pregunta'];
        redirect('RealizarEvaluacionPregunta.php?id='.$id.'&id_curso='.$id_curso.'&id_pregunta='.$id_pregunta.'&id_respuesta=', false);
      endforeach;
      if ($existen_preguntas === 0){
          $sql = "INSERT into estudiante_historial (id_user,id_curso_oferta,id_evaluacion,cantidad_aciertos) values ('{$user}','{$id_curso}','{$id}', (select count(*) from evaluacion_estudiante where id_user = '{$user}' and id_curso_oferta = '{$id_curso}' and id_evaluacion = '{$id}' and respuesta_estudiante='SI' and valida = respuesta_estudiante))";
          $result = $db->query($sql);   
          $evaluacion_info = find_by_id('contenido_curso',$id);
          if (isset($evaluacion_info['descripcion'])){
              $descripcion = $evaluacion_info['descripcion'];
              $cant_preguntas = $evaluacion_info['cantidad_preguntas'];
              //if (isset($descripcion)){
              //  $sqlconsolidado = "INSERT into consolidado_estudiante (id_user, id_curso, descripcion, calificacion) values ('{$user}','{$id_curso}','{$descripcion}',(select round((count(*)/'{$cant_preguntas}')*10) from evaluacion_estudiante where id_user = '{$user}' and id_curso_oferta = '{$id_curso}' and id_evaluacion = '{$id}' and respuesta_estudiante='SI' and valida = respuesta_estudiante))";
                //$result2 = $db->query($sqlconsolidado);   
              //}
          }
          redirect('FinEvaluacion.php?id='.$id.'&id_curso='.$id_curso, false);
      }
  } else {
    echo "<script>alert(\"Usted ya realizo la evaluacion...!\");</script>";
    redirect('FinEvaluacion.php?id='.$id.'&id_curso='.$id_curso, false);
  }
?>
<?php 
if(isset($_POST['regresar'])) {
      //echo $id_curso;
      redirect('ConsultaCursoInfoDesarrollo.php?id='.$id_curso.'&objetivo=&video=&id_contenido=0&tema=', false);
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/jquery.bxslider.css">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="libs/js/jquery.bxslider.js"></script>

</head>
<body>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>