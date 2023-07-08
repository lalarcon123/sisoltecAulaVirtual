<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query   = "SELECT c.id, 
                       convert(cast(convert(c.descripcion using latin1) as binary) using utf8) AS descripcion, 
                       convert(cast(convert(c.objetivo using latin1) as binary) using utf8) AS objetivo,  
                       c.id_categoria, 
                       c.fecha_registro, 
                       c.duracion, 
                       c.puntaje_minimo, 
                       c.imagen, 
                       c.id_usuario, ";
    $query  .= "       concat(u.name,' ',u.last_name) as nombre, 
                       (case c.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado ";
    $query  .= "  FROM curso c, 
                       users u 
                 WHERE u.id = c.id_usuario ";
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
