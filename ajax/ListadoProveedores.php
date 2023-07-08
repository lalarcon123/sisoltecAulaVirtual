<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "SELECT p.id, p.nombre, p.descripcion, p.ruc, p.direccion, p.mail, p.telefono, p.responsable, p.telefono_representante, p.fecha_registro, p.sitioweb, (case p.estado  WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado FROM proveedores p";
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
