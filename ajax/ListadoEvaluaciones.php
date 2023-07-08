<?php
    $id_curso = $_GET['id_curso'];
    $id = $_GET['id'];

    include "../includes/config.php";//Contiene funcion que conecta a la base de datos

    $query = "select cc.id_curso, c.descripcion, cc.id,  cc.descripcion, concat(u.name, ' ',u.last_name) as estudiante, ";
    $query  .= " eh.cantidad_aciertos, cc.cantidad_preguntas, ";
    $query  .= " round(((eh.cantidad_aciertos/cc.cantidad_preguntas)*100),2) as puntaje, co.id_docente ";
    $query  .= " from contenido_curso cc Left JOIN estudiante_historial eh on ";
    $query  .= " (eh.id_curso_oferta = cc.id_curso and eh.id_evaluacion = cc.id) ";
    $query  .= "                       LEFT JOIN users u on (u.id =  eh.id_user) ";
    $query  .= "                       left join curso_oferta co on (co.id = cc.id_curso) ";
    $query  .= "                       inner join curso c on (c.id = co.id_curso)  ";
    $query  .= " where cc.estado = 1 ";
    $query  .= " and (cc.id_curso = '{$id_curso}') ";
    $query  .= " and (cc.id = '{$id}') ";

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
