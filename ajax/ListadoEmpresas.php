<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "SELECT e.id,
                     e.ruc, 
                     e.nombre, 
                     e.descripcion, 
                     e.telefono, 
                     e.correo, 
                     e.direccion, 
                     e.representante, 
                     (CASE e.estado WHEN '1' THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado 
                FROM empresas e 
            ORDER BY e.nombre ASC ";
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
