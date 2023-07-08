<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos


    $query  = "SELECT t.id, t.descripcion, (CASE t.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) AS estado FROM tipo_tarea t ";
    $query .= " ORDER BY t.descripcion ASC ";

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
