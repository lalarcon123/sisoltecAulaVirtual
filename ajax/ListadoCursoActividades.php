<?php
    $id      = $_GET['id'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de   datos

    $query   = "SELECT a.id, 
                       a.id_curso_oferta, 
                       convert(cast(convert(a.descripcion using latin1) as binary) using utf8) AS descripcion, 
                       a.fecha_maxima, 
                       a.calificable, 
                       (case a.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado,
                       a.documento 
                  FROM actividades_curso a 
                  WHERE a.id_curso_oferta = ";
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
