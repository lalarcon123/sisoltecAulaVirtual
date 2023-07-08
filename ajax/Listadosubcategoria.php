<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "SELECT c.id as id_categoria, c.descripcion as descripcion_categoria, s.id, s.descripcion, (case s.estado  WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado FROM subcategoria s, categoria c where c.id = s.id_categoria";
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
