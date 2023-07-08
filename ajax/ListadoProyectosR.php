<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos
    $id           = $_GET['id'];
    $fecha_inicio = $_GET['fecha_inicio'];
    $fecha_fin    = $_GET['fecha_fin']; 

    $query  = "SELECT p.id, p.codigoproy, p.nombre, p.descripcion, p.tipo_proyecto, t.descripcion as tipo_proy_desc, ";
    $query .= " p.responsable, concat(u.name, ' ', u.last_name) as nombre_responsable, ";
    $query .= " p.id_cliente, c.descripcion as nombre_cliente, ";
    $query .= " p.fecha_inicio, p.fecha_fin, (CASE p.estado WHEN '1' THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado, p.planproyecto, p.cronograma ";
    $query .= " FROM proyectos p INNER JOIN tipo_proyecto t on t.id = p.tipo_proyecto INNER JOIN users u on u.id = p.responsable INNER JOIN clientes c on c.id = p.id_cliente WHERE ((p.responsable = '{$id}' or '{$id}' = 1) OR (EXISTS (SELECT * FROM users u, user_groups g WHERE u.id = '{$id}' AND g.group_level = u.user_level and g.id = 4)) OR 
         (EXISTS (SELECT * FROM recursos_proyectos rp WHERE rp.id_user = '{$id}' AND rp.id_proyecto = p.id)))
          AND p.fecha_inicio between  CAST('{$fecha_inicio}' AS DATE) AND CAST('{$fecha_fin}' AS DATE)";

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
