<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $id      = $_GET['id'];


    $query  ="SELECT d.id, d.id_solicitud_compra, d.id_producto, p.nombre, ";
    $query .="       d.precio, d.cantidad, IFNULL(d.cantidad_recibida, d.cantidad) as cantidad_recibida , s.id_proveedor, r.nombre as nombre_proveedor, ";
    $query .="       (case d.estado WHEN 1 THEN 'ACTIVO' WHEN 2 THEN 'INACTIVO' ELSE 'RECEPTADO' END) as ";
    $query .="       estado  ";
    $query .="  FROM detalle_solicitud_compra d, solicitudcompra s, productos p, proveedores r ";
    $query .=" WHERE s.id = d.id_solicitud_compra ";
    $query .="   AND p.id = d.id_producto ";
    $query .="   AND s.id_proveedor = r.id ";
    $query .="   AND d.id_solicitud_compra = ";
    $query .=" '{$id}'";
    
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
