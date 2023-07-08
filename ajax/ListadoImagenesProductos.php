<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $id      = $_GET['id'];


    $query = "SELECT p.id, p.id_producto, p.imagen, ";
    $query .=" (case p.estado when '1' then 'ACTIVO' when '3' then 'FINALIZADA' ELSE 'INACTIVO' end) as estado  ";
    $query .=" FROM producto_imagenes p ";
    $query .=" where p.id_producto = ";
    $query .= " '{$id}'";


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
