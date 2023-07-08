<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "SELECT ug.id, ug.group_name, ug.group_level, (case ug.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado FROM user_groups ug ";
    
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
