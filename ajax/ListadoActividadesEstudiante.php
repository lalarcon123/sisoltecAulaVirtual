<?php
    $id_curso = $_GET['id_curso'];
    $id_user = $_GET['id_user'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "  SELECT ac.id_curso_oferta,
                       c.descripcion as desc_curso,
                       ac.id_user,
                       CONCAT(u.name,' ',u.last_name) as estudiante,
                       ac.id_actividad,
                       ac.descripcion,
                       ac.fecha_maxima,
                       ac.documento,
                       ac.fecha_registro,
                       ac.fecha_carga,
                       ac.calificacion
                  FROM actividades_curso_estudiante ac,
                       users u,
                       curso_oferta co,
                       curso c
                 WHERE u.id = ac.id_user
                   AND co.id = ac.id_curso_oferta
                   AND c.id  = co.id_curso
                   AND ac.id_curso_oferta =  '{$id_curso}' 
                   AND ac.id_user = '{$id_user}'";

    //echo $query;
    $resultado = mysqli_query($con,$query);

    if ($resultado){
        while($data = mysqli_fetch_assoc($resultado)){
            $arreglo["data"][] = array_map("utf8_encode",$data);
        }
        echo json_encode($arreglo);
    }
    mysqli_free_result($resultado);
    mysqli_close($con);
?>
