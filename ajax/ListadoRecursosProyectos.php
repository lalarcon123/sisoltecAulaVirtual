<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos
    $id     = $_GET['id'];

    $query  = "SELECT rp.id, rp.id_proyecto, p.descripcion as desc_proyecto, ";
    $query .= " p.responsable, concat(r.name, ' ', r.last_name) as nombre_responsable,  ";
    $query .= " rp.id_user, concat(u.name, ' ', u.last_name) as nombre_trabajador,  ";
    $query .= " (CASE rp.estado WHEN '1' THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado ";
    $query .= " FROM recursos_proyectos rp, proyectos p, users u , users r ";
    $query .= " WHERE p.id = rp.id_proyecto and u.id = rp.id_user and r.id = p.responsable and rp.id_proyecto = '{$id}'";

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
