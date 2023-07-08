<?php
    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "SELECT dm.det_menu_id, m.descripcion as descripcion_menu, dm.id_menu, dm.descripcion, (case dm.estado  WHEN 1 THEN 'ACTIVO' ELSE 'INACTIVO' END) as estado, dm.observacion, dm.pagina FROM det_menu dm, menu m where m.id_menu = dm.id_menu ";
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
