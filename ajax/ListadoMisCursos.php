<?php
    $id_user  = $_GET['id_user'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

        $query = "SELECT ec.id_curso, 
                     convert(cast(convert(c.descripcion using latin1) as binary) using utf8) AS descripcion, 
                     ec.id_user, 
                     concat(u.name,' ',u.last_name) as estudiante, 
                     ec.calificacion, 
                     ec.fecha_finalizacion FROM ";
    $query  .= " estudiante_curso ec, curso_oferta co, curso c, users u ";
    $query  .= " WHERE co.id = ec.id_curso ";
    $query  .= " AND c.id = co.id_curso ";
    $query  .= " AND u.id = ec.id_user ";
    $query  .= " AND ec.id_user = '{$id_user}' ";

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
