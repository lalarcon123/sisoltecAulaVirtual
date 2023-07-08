<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "SELECT s.id, s.id_proveedor, p.nombre, s.forma_pago,";
    $query .=" (case s.forma_pago WHEN 1 THEN 'EFECTIVO' ";
    $query .="                    WHEN 2 THEN 'CRÉDITO DIRECTO' ";
    $query .="                    WHEN 3 THEN 'TARJETA DE CRÉDITO'"; 
    $query .="                    WHEN 4 THEN 'CHEQUE' ";
    $query .=" ELSE 'TRANSFERENCIA BANCARIA' END) AS  forma_pagod,";
    $query .=" s.fecha, s.id_user, concat(u.name, ' ', u.last_name) as usuario,";
    $query .=" s.monto, s.observacion, ";
    $query .=" (case s.estado WHEN 1 THEN 'ACTIVO' WHEN 2 THEN 'INACTIVO' ELSE 'FINALIZADA' END) as estado ";
    $query .=" FROM solicitudcompra s, proveedores p, users u ";
    $query .=" WHERE p.id = s.id_proveedor ";
    $query .=" AND u.id = s.id_user ";


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
