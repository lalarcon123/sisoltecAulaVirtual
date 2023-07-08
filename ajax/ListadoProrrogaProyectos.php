<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos
    $id     = $_GET['id'];

    $query  = "SELECT pp.id,  ";
    $query .= "  pp.id_proyecto, "; 
    $query .= "  p.nombre,  ";
    $query .= "  pp.fecha_fin_anterior,  ";
    $query .= "  pp.fecha_fin,  ";
    $query .= "  pp.archivo,  ";
    $query .= "  (CASE pp.estado WHEN '1' THEN 'INGRESADO'  ";
    $query .= "                  WHEN '2' THEN 'APROBADO' ELSE 'RECHAZADO' END) as estado  ";
    $query .= "  FROM prorroga_proyecto pp,  ";
    $query .= "       proyectos p  ";
    $query .= " WHERE p.id = pp.id_proyecto  ";
    $query .= "   AND pp.id_proyecto = '{$id}'";

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
