<?php
    $id      = $_GET['id'];

    mb_internal_encoding('UTF-8');
         
    // Esto le dice a PHP que generaremos cadenas UTF-8
    mb_http_output('UTF-8');

    include "../includes/config.php";//Contiene funcion que conecta a la base de   datos

    $query   = "SELECT cc.id, 
                       cc.id_curso, 
                       convert(cast(convert(cc.descripcion using latin1)  as binary) using utf8) as descripcion, 
                       cc.fecha_registro, 
                       cc.fecha_inicio, 
                       cc.fecha_fin, 
                       cc.cantidad_preguntas, 
                       (case cc.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado
                  FROM contenido_curso cc WHERE cc.id_curso = ";
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
    header('Content-Type: text/html; charset=UTF-8');
?>
