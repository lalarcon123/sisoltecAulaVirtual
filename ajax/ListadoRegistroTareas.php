<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $id         = $_GET['id'];
    $id_usuario = $_GET['id_usuario'];


    $query = "SELECT r.id_proyecto as id_proy, r.id, r.descripcion, r.fecha_inicio, ";
    $query .=" r.fecha_fin, r.fecha_entrega, r.id_tipo_tarea,  ";
    $query .=" t.descripcion as desc_tipo_tarea, ";
    $query .=" p.descripcion as desc_proyecto, concat(re.name, ' ', re.last_name) as responsable_proyecto, r.documento,  ";
    $query .=" (case r.estado when '1' then 'ACTIVO' when '3' then 'FINALIZADA' ELSE 'INACTIVO' end) as estado , ";
    $query .=" observacion, evidencia, avance, ";
    $query .=" r.responsable, concat(u.name, ' ', u.last_name) as nombre_responsable ";
    $query .=" FROM registro_tarea r ";
    $query .=" inner join tipo_tarea t  ";
    $query .=" on t.id = r.id_tipo_tarea left join proyectos p  ";
    $query .=" on p.id = r.id_proyecto inner join users re on re.id = p.responsable inner join users u on u.id = r.responsable WHERE ((r.id_proyecto = ";
    $query .= " '{$id}') AND ((r.responsable = '{$id_usuario}') OR ('{$id_usuario}' = '1') OR (EXISTS (SELECT * FROM proyectos p WHERE p.id = r.id_proyecto AND p.responsable = '{$id_usuario}')) OR (EXISTS (SELECT * FROM users u WHERE u.id = '{$id_usuario}' AND u.user_level = '4')))) ";
    
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
