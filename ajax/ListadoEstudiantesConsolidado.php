<?php
    $id_curso = $_GET['id_curso'];
    $id_user  = $_GET['id_user'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "SELECT ce.id_curso, 
                     convert(cast(convert(c.descripcion using latin1) as binary) using utf8) AS descripcion_curso, 
                     ce.id_user, ";
    $query  .= " concat (u.name,' ', u.last_name) as estudiante, ";
    $query  .= " ce.descripcion, ce.calificacion ";
    $query  .= " FROM consolidado_estudiante ce ";
    $query  .= " LEFT JOIN curso_oferta co on (co.id = ce.id_curso) ";
    $query  .= " LEFT JOIN curso c on (c.id = co.id_curso) ";
    $query  .= " LEFT JOIN users u on (u.id = ce.id_user) ";
    $query  .= " WHERE ce.id_curso = '{$id_curso}'"; 
    $query  .= "  AND  (ce.id_user = '{$id_user}' or '{$id_user}'= '0')"; 


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
