<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "SELECT t.id, 
                     convert(cast(convert(t.descripcion using latin1) as binary) using utf8) AS descripcion, 
                     (case t.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado 
                     FROM tipo_material t ";
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
