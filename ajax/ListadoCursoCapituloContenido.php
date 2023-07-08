<?php
    $id      = $_GET['id'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de   datos

    $query   = "SELECT cp.id, 
                       cp.id_curso, 
                       cp.id_capitulo, 
                       convert(cast(convert(cp.descripcion using latin1) as binary) using utf8) AS descripcion,
                       convert(cast(convert(cp.objetivo using latin1) as binary) using utf8) AS objetivo,
                       cp.duracion , 
                       convert(cast(convert(cp.tema using latin1) as binary) using utf8) AS tema, 
                       cp.multimedia, 
                       (case cp.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as status 
                  FROM contenido_capitulo cp WHERE cp.id_capitulo = ";
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
