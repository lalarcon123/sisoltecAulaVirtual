<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $id      = $_GET['id'];

    $query = " SELECT pp.id, pp.id_producto, p.nombre,   ";
    $query .=" pp.id_proveedor, r.descripcion, pp.precio, ";
    $query .=" (case pp.estado when '1' then 'ACTIVO' when '3' then 'FINALIZADA' ELSE 'INACTIVO' end) as estado  ";
    $query .=" FROM producto_proveedores pp, productos p, proveedores r  ";
    $query .=" WHERE p.id = pp.id_producto  ";
    $query .=" AND r.id = pp.id_proveedor ";
    $query .=" AND pp.id_producto = '{$id}' ";

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
