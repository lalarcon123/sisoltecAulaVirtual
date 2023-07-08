<?php
    $id_curso  = $_GET['id_curso'];
    $id_user   = $_GET['id_user'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de   datos

    $query   = "SELECT id_user, 
                       id_curso_oferta, 
                       id_actividad, 
                       convert(cast(convert(descripcion using latin1)  as binary) using utf8) AS descripcion,
                       fecha_maxima, 
                       documento, 
                       fecha_carga, 
                       calificacion 
                  FROM actividades_curso_estudiante 
                 WHERE id_user = '{$id_user}' 
                   AND id_curso_oferta = '{$id_curso}' ";

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
