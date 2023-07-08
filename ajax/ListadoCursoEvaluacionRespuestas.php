<?php
    $id      = $_GET['id'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de   datos

    $query   = "SELECT r.id, 
                       r.id_pregunta, 
                       convert(cast(convert(r.descripcion using latin1) as binary) using utf8) AS descripcion, 
                       r.valida, 
                       (case r.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado 
                  FROM evaluacion_respuestas r WHERE r.id_pregunta =";
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
