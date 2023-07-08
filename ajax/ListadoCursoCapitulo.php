<?php
    $id      = $_GET['id'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de   datos

    $query   = "SELECT cc.id,  
                       cc.id_curso, 
                       convert(cast(convert(cc.descripcion using latin1) as binary) using utf8) AS descripcion,
                       convert(cast(convert(cc.objetivo using latin1) as binary) using utf8) AS objetivo, 
                       cc.duracion, 
                       (case cc.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado
                  FROM capitulos_curso cc where cc.id_curso = ";
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
