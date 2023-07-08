<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $id      = $_GET['id'];


    $query = "SELECT dm.id_menu,
                      m.descripcion as menu,
                     dm.det_menu_id, 
                     dm.descripcion, 
                     dm.observacion,
                     um.grupo_id,
                     dm.pagina,
                     (CASE um.estado WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado
                FROM menu m, det_menu dm, usuario_menu um
               WHERE m.id_menu  = dm.id_menu
                 AND dm.det_menu_id =  um.det_menu_id
                 AND um.grupo_id    = '{$id}'
            ORDER BY dm.det_menu_id ";


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
