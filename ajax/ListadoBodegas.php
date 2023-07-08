<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos


    $query  = " SELECT b.id, 
                       b.descripcion, 
                       b.direccion, 
                       b.responsable, 
                       CONCAT(u.name, ' ',u.last_name) AS nombre_responsable, 
                       (CASE b.estado WHEN '1' THEN 'ACTIVO' ELSE 'INACTIVO' END) AS estado 
                 FROM bodegas b, 
                      users u 
            WHERE u.id = b.responsable";
    $query .= " ORDER BY b.descripcion ASC ";

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
