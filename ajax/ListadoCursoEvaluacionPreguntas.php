<?php
    $id      = $_GET['id'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de   datos

    $query   = "SELECT e.id, 
                       e.id_evaluacion, 
                       e.numero_pregunta, 
                       convert(cast(convert(e.pregunta using latin1)  as binary) using utf8)  as pregunta,
                       (case e.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado 
                  FROM evaluacion_preguntas e WHERE e.id_evaluacion = ";
    $query  .= " '{$id}'";

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
